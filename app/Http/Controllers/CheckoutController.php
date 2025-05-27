<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;
use App\Models\Keranjang;
use App\Models\MetodeBayar;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction;

class CheckoutController extends Controller
{
    //

    public function __construct()
    {
        \Config::set('midtrans.server_key', config('midtrans.server_key'));
        \Config::set('midtrans.client_key', config('midtrans.client_key'));
        \Config::set('midtrans.is_production', config('midtrans.is_production'));
        \Config::set('midtrans.sanitized', config('midtrans.sanitized'));
        \Config::set('midtrans.3ds', config('midtrans.3ds'));

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_ production');
        \Midtrans\Config::$isSanitized = config('midtrans.sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.3ds');
    }

    public function getSnapToken(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:penjualan,id',
        ]);

        $penjualan = Penjualan::with('pelanggan')->findOrFail($request->order_id);

        if ($penjualan->status_order !== 'Menunggu Konfirmasi') {
            return response()->json(['message' => 'Pesanan tidak dapat dibayar karena status bukan "Menunggu Konfirmasi".'], 400);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $penjualan->order_id,
                'gross_amount' => $penjualan->total_bayar,
            ],
            'customer_details' => [
                'first_name' => $penjualan->pelanggan->nama_pelanggan,
                'email' => $penjualan->pelanggan->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json(['token' => $snapToken]);
    }

    public function toCheckout(Request $request)
    {
        $jenisKirim = JenisPengiriman::where('nama_ekspedisi', $request->input('jenis_pengiriman'))->first();
        $pelanggan = Pelanggan::find($request->input('id_pelanggan'));

        if (!$jenisKirim || !$pelanggan) {
            return response()->json(['error' => 'Data pengiriman atau pelanggan tidak valid'], 400);
        }

        $keranjangs = Keranjang::where('id_pelanggan', $request->id_pelanggan)->get();

        if ($keranjangs->isEmpty()) {
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }

        DB::beginTransaction();
        try {
            $penjualan = Penjualan::create([
                'id_jenis_kirim' => $jenisKirim->id,
                'id_pelanggan' => $request->id_pelanggan,
                'total_bayar' => $request->total,
                'ongkos_kirim' => $request->ongkir,
                'status_order' => 'Menunggu Konfirmasi',
                'keterangan_status' => 'dibayar oleh midtrans',
                'order_id' => 'ORD-' . Str::uuid()->toString(),
                'tgl_penjualan' => Carbon::now(),
            ]);

            foreach ($keranjangs as $item) {
                PenjualanDetail::create([
                    'id_penjualan' => $penjualan->id,
                    'id_obat' => $item->id_obat,
                    'jumlah_beli' => $item->jumlah_order,
                    'harga_beli' => $item->harga,
                    'subtotal' => $item->subtotal,
                ]);
            }

            Keranjang::where('id_pelanggan', $request->id_pelanggan)->delete();

            DB::commit();

            return response()->json(['message' => 'Checkout berhasil', 'order_id' => $penjualan->order_id, 'success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal checkout: ' . $e->getMessage(), 'success' => false], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        // Ambil data dari request yang diberikan oleh Midtrans
        $transaction = $request->transaction_status;
        $order_id = $request->order_id;
        $fraud = $request->fraud_status;
        $payment_type = $request->payment_type; // jenis metode pembayaran
        $va_number = $request->va_number ?? null; // jika ada, untuk bank transfer
        $acquirer = $request->acquirer ?? null; // untuk informasi pengakuisisi, seperti 'airpay shopee'
        $gross_amount = $request->gross_amount; // jumlah pembayaran

        // Cari penjualan berdasarkan order_id
        $penjualan = Penjualan::where('order_id', $order_id)->first();

        if (!$penjualan) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $penjualan->status_order = 'Bermasalah';
                $penjualan->keterangan_status = 'Menunggu verifikasi manual dari Midtrans';
            } elseif ($fraud == 'accept') {
                $penjualan->status_order = 'Menunggu Konfirmasi';
                $penjualan->keterangan_status = 'Pembayaran diterima (capture)';
            }
        } elseif ($transaction == 'settlement') {
            $penjualan->status_order = 'Diproses';
            $penjualan->keterangan_status = 'Pembayaran berhasil (settlement)';
        } elseif ($transaction == 'pending') {
            $penjualan->status_order = 'Menunggu Konfirmasi';
            $penjualan->keterangan_status = 'Menunggu pembayaran dari pelanggan';
        } elseif ($transaction == 'deny') {
            $penjualan->status_order = 'Bermasalah';
            $penjualan->keterangan_status = 'Transaksi ditolak oleh Midtrans';
        } elseif ($transaction == 'cancel') {
            $penjualan->status_order = 'Dibatalkan Pembeli';
            $penjualan->keterangan_status = 'Pembayaran dibatalkan';
        } elseif ($transaction == 'expire') {
            $penjualan->status_order = 'Dibatalkan Pembeli';
            $penjualan->keterangan_status = 'Waktu pembayaran habis';
        }

        $metodeBayar = MetodeBayar::updateOrCreate(
            ['metode_pembayaran' => $payment_type],
            [
                'tempat_bayar' => 'midtrans',
                'no_rekening' => $va_number ?? 123123213,
                'url_logo' => 'path_to_logo',
            ],
        );

        // Set id_metode_bayar pada penjualan
        $penjualan->id_metode_bayar = $metodeBayar->id;

        // Simpan perubahan status penjualan
        $penjualan->save();

        return response()->json(['message' => 'Notifikasi diproses'], 200);
    }

    public function addResep(Request $request, $id)
    {
        $order = Penjualan::findOrFail($id);

        if ($request->has('url_resep')) {
            $urlResep = $request->file('url_resep')->store('resep', 'public');
            $order->update([
                'url_resep' => $urlResep,
            ]);
            return redirect()->back()->with('success', 'berhasil menambahkan resep dokter');
        } else {
            return redirect()->back()->with('error', 'Ops, harap masukan foto resep dari dokter anda!');
        }
    }
}
