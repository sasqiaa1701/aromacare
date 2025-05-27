<?php

namespace App\Http\Controllers;

use App\Models\JenisObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisObatController extends Controller
{
    //
    public function index()
    {
        $jenisObats = JenisObat::all();
        return view('dashboard.jenis-obat.index', compact('jenisObats'));
    }


    public function create()
    {
        return view('dashboard.jenis-obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|string|max:100',
            'deskripsi_jenis' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('jenis-obat', 'public');
        }

        JenisObat::create([
            'jenis' => $validated['jenis'],
            'deskripsi_jenis' => $validated['deskripsi_jenis'] ?? null,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('jenis-obat.index')->with('success', 'Jenis obat berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        try {
            $jenis = JenisObat::where('id', $id)->first();
            $jenis->delete();
            return redirect()->route('jenis-obat.index')->with('success', 'Jenis obat berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('jenis-obat.index')->with('error', $th->getMessage());
        }
    }


    public function edit($id)
    {
        $jenisObat = JenisObat::where('id', $id)->first();
        if (!$jenisObat)  return abort(404);
        return view('dashboard.jenis-obat.edit', compact('jenisObat'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis' => 'required|string|max:100',
            'deskripsi_jenis' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $jenisObat = JenisObat::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($jenisObat->image_url && Storage::exists('public/' . $jenisObat->image_url)) {
                Storage::delete('public/' . $jenisObat->image_url);
            }

            $imagePath = $request->file('image')->store('jenis-obat', 'public');
        } else {
            $imagePath = $jenisObat->image_url;
        }

        $jenisObat->update([
            'jenis' => $validated['jenis'],
            'deskripsi_jenis' => $validated['deskripsi_jenis'] ?? null,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('jenis-obat.index')->with('success', 'Jenis obat berhasil diperbarui!');
    }
}
