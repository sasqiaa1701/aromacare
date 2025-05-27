<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenjualanController extends Controller
{
    //

    public function index()
    {
        $penjualan = Penjualan::all();
        return view('dashboard.penjualan.index', compact('penjualan'));
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'detail_penjualan.obat', 'detail_penjualan', 'metode_bayar')->where('order_id', $id)->first();
        return view('dashboard.penjualan.show', compact('penjualan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_order' => 'required',
        ]);

        $penjualan = Penjualan::with('detail_penjualan')->where('order_id', $id)->firstOrFail();
        $penjualan->status_order = $request->status_order;

        if ($request->input('status_order') == 'Menunggu Kurir') {
            foreach ($penjualan->detail_penjualan as $key => $value) {
                $obat = Obat::find($value->id_obat);
                $obat->update([
                    'stok' => $obat->stok - $value->jumlah_beli,
                ]);
            }
        }

        $penjualan->save();

        return redirect()->route('penjualan.show', $penjualan->order_id)->with('success', 'Status Berhasil diperbarui!');
    }

    public function destroy($order_id)
    {
        $penjualan = Penjualan::where('order_id', $order_id)->first();
        if (!$penjualan) {
            return abort(404, 'order not found!');
        }
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function laporan(Request $request)
    {
        $query = Penjualan::query();

        if ($request->filled('tgl_penjualan')) {
            $query->whereDate('tgl_penjualan', $request->tgl_penjualan);
        }

        $laporans = $query->get();

        return view('dashboard.penjualan.laporan.index', compact('laporans'));
    }

    public function print($orderId)
    {
        $penjualan = Penjualan::where('order_id', $orderId)->first();

        return view('dashboard.penjualan.laporan.nota', compact('penjualan'));
    }
}
