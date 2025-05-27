<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;
use App\Models\Keranjang;
use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedController extends Controller
{
    //

    public function addToCart(Request $request, $id)
    {
        $user = auth('pelanggan')->user();
        $obat = Obat::find($id);

        if (!$obat) {
            return redirect()->back()->with('error', 'Obat tidak ditemukan.');
        }

        $jumlah = $request->input('jumlah_order');

        $keranjang = Keranjang::where('id_pelanggan', $user->id)
            ->where('id_obat', $id)
            ->first();

        if ($keranjang) {
            // Jika jumlah tidak diisi, tambahkan 1 dari jumlah sebelumnya
            if ($jumlah === null) {
                $keranjang->jumlah_order += 1;
            } else {
                $keranjang->jumlah_order = $jumlah;
            }

            $keranjang->subtotal = $keranjang->jumlah_order * $obat->harga_jual;
            $keranjang->save();

            return redirect()->back()->with('success', 'Jumlah obat diperbarui di keranjang.');
        } else {
            $jumlahToCart = $jumlah ?? 1;

            Keranjang::create([
                'id_pelanggan' => $user->id,
                'id_obat' => $id,
                'jumlah_order' => $jumlahToCart,
                'harga' => $obat->harga_jual,
                'subtotal' => $obat->harga_jual * $jumlahToCart,
            ]);

            return redirect()->back()->with('success', 'Obat berhasil ditambahkan ke keranjang.');
        }
    }



    public function cart()
    {
        $keranjangs = auth('pelanggan')->user()->keranjangs;
        $jenisPengirimans = JenisPengiriman::get();
        return view('cart', compact('keranjangs', 'jenisPengirimans'));
    }


    public function checkout()
    {
        $orders = Penjualan::with(['metode_bayar', 'detail_penjualan.obat'])->where('id_pelanggan', auth('pelanggan')->id())->get();

        return view('checkout', compact('orders'));
    }


    public function cancel($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();
        $penjualan->update(
            [
                'status_order' => 'Dibatalkan Pembeli'
            ]
        );

        return redirect()->back()->with('success', 'berhasil membatalkan pesanan');
    }

    public function profile()
    {
        $pelanggan = auth('pelanggan')->user();
        return view('profile', compact('pelanggan'));
    }

    public function updateProfile(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        $pelanggan->no_telp = $request->no_telp;

        for ($i = 1; $i <= 3; $i++) {
            $pelanggan->{'alamat' . $i} = $request->{'alamat' . $i};
            $pelanggan->{'kota' . $i} = $request->{'kota' . $i};
            $pelanggan->{'provinsi' . $i} = $request->{'provinsi' . $i};
            $pelanggan->{'kodepos' . $i} = $request->{'kodepos' . $i};
        }

        if ($request->filled('katakunci')) {
            $pelanggan->katakunci = Hash::make($request->katakunci);
        }

        if ($request->hasFile('url_ktp')) {
            $ktp = $request->file('url_ktp');
            $ktpName = time() . '_ktp.' . $ktp->getClientOriginalExtension();
            $ktp->move(public_path('uploads/pelanggan'), $ktpName);
            $pelanggan->url_ktp = 'uploads/pelanggan/' . $ktpName;
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_foto.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/pelanggan'), $fotoName);
            $pelanggan->foto = 'uploads/pelanggan/' . $fotoName;
        }


        $pelanggan->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }


    public function logout()
    {
        Auth::guard('pelanggan')->logout();
        return redirect()->to('/')->with('success', 'berhasil logout');
    }
}
