<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class PembelianController extends Controller
{
    //
    public function index()
    {
        $distributors = Distributor::all();
        $obats = Obat::all();
        return view('dashboard.pembelian.index', compact('distributors', 'obats'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nota' => 'required|unique:pembelian,nota',
            'tgl_pembelian' => 'required|date',
            'id_distributor' => 'required|exists:distributor,id',
            'obat_id' => 'required|array',
            'jumlah_beli' => 'required|array',
            'harga_beli' => 'required|array',
            'subtotal' => 'required|array',
        ]);

        $pembelian = Pembelian::create([
            'nota' => $request->nota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'id_distributor' => $request->id_distributor,
            'total_bayar' => $request->total_bayar,
        ]);

        foreach ($request->obat_id as $index => $obat_id) {
            PembelianDetail::create([
                'id_pembelian' => $pembelian->id,
                'id_obat' => $obat_id,
                'jumlah_beli' => $request->jumlah_beli[$index],
                'harga_beli' => $request->harga_beli[$index],
                'subtotal' => $request->subtotal[$index],
            ]);

            $obat = Obat::find($obat_id);
            $obat->stok += $request->jumlah_beli[$index];
            $obat->save();
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil disimpan.');
    }


    public function laporan(Request $request)
    {
        $query = Pembelian::with('detailPembelians', 'distributor', 'detailPembelians.obat');

        if ($request->filled('tgl_pembelian')) {
            $query->whereDate('tgl_pembelian', $request->tgl_pembelian);
        }

        if ($request->filled('id_distributor')) {
            $query->where('id_distributor', $request->id_distributor);
        }

        $laporans = $query->latest()->paginate(10);
        $distributors = Distributor::all();

        return view('dashboard.pembelian.laporan.index', compact('laporans', 'distributors'));
    }



    public function laporanShow($id)
    {
        $pembelian = Pembelian::with(['distributor', 'detailPembelians.obat'])->findOrFail($id);
        return view('dashboard.pembelian.laporan.show', compact('pembelian'));
    }


    public function printNota($id)
    {
        $pembelian = Pembelian::with(['distributor', 'detailPembelians.obat'])->findOrFail($id);
        return view('dashboard.pembelian.laporan.nota', compact('pembelian'));
    }


    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();
        return redirect()->back()->with('success', 'berhasil menghapus riwayat pembelian');
    }



}
