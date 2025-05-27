<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisPengirimanController extends Controller
{
    //
    public function index()
    {
        $jenisPengiriman = JenisPengiriman::all();
        return view('dashboard.jenis-pengiriman.index', compact('jenisPengiriman'));
    }


    public function create()
    {
        return view('dashboard.jenis-pengiriman.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kirim' => 'required|in:kargo,ekonomi,regular,same day,standar',
            'nama_ekspedisi' => 'required|string|max:255',
            'logo_ekspedisi' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($request->hasFile('logo_ekspedisi')) {
            $file = $request->file('logo_ekspedisi');
            $fileName = uniqid('logo_') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('logo-ekspedisi', $fileName, 'public');
            $validated['logo_ekspedisi'] = $path;
        }

        JenisPengiriman::create($validated);

        return redirect()->route('jenis-pengiriman.index')->with('success', 'Jenis pengiriman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisPengiriman = JenisPengiriman::find($id);
        return view('dashboard.jenis-pengiriman.edit', compact('jenisPengiriman'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kirim' => 'required|in:kargo,ekonomi,regular,same day,standar',
            'nama_ekspedisi' => 'required|string|max:255',
            'logo_ekspedisi' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $jenisPengiriman = JenisPengiriman::findOrFail($id);
        $jenisPengiriman->jenis_kirim = $request->jenis_kirim;
        $jenisPengiriman->nama_ekspedisi = $request->nama_ekspedisi;

        if ($request->hasFile('logo_ekspedisi')) {
            // Hapus logo lama jika ada
            if ($jenisPengiriman->logo_ekspedisi && Storage::exists($jenisPengiriman->logo_ekspedisi)) {
                Storage::delete($jenisPengiriman->logo_ekspedisi);
            }

            // Simpan logo baru
            $path = $request->file('logo_ekspedisi')->store('jenis-pengiriman', 'public');
            $jenisPengiriman->logo_ekspedisi = $path;
        }

        $jenisPengiriman->save();

        return redirect()->route('jenis-pengiriman.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $jenisPengiriman = JenisPengiriman::findOrFail($id);

        if ($jenisPengiriman->logo_ekspedisi && Storage::exists($jenisPengiriman->logo_ekspedisi)) {
            Storage::delete($jenisPengiriman->logo_ekspedisi);
        }

        $jenisPengiriman->delete();

        return redirect()->route('jenis-pengiriman.index')->with('success', 'Data berhasil dihapus.');
    }
}
