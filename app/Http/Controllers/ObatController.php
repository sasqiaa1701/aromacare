<?php

namespace App\Http\Controllers;

use App\Models\JenisObat;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('jenisObat')
            ->when(request('search'), function ($query) {
                $query->where('nama_obat', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate();
        return view('dashboard.obat.index', compact('obats'));
    }

    public function create()
    {
        $jenisObat = JenisObat::all();
        return view('dashboard.obat.create', compact('jenisObat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'id_jenis' => 'required|exists:jenis_obat,id',
            'harga_jual' => 'required|integer',
            'deskripsi_obat' => 'required|string',
            'foto1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stok' => 'required|integer',
        ]);

        $foto1Path = $request->hasFile('foto1') ? $request->file('foto1')->store('obat', 'public') : null;
        $foto2Path = $request->hasFile('foto2') ? $request->file('foto2')->store('obat', 'public') : null;
        $foto3Path = $request->hasFile('foto3') ? $request->file('foto3')->store('obat', 'public') : null;

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'id_jenis' => $request->id_jenis,
            'harga_jual' => $request->harga_jual,
            'deskripsi_obat' => $request->deskripsi_obat,
            'foto1' => $foto1Path,
            'foto2' => $foto2Path,
            'foto3' => $foto3Path,
            'stok' => $request->stok,
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $jenisObat = JenisObat::all();
        return view('dashboard.obat.edit', compact('obat', 'jenisObat'));
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'id_jenis' => 'required|exists:jenis_obat,id',
            'harga_jual' => 'required|integer',
            'deskripsi_obat' => 'required|string',
            'foto1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stok' => 'required|integer',
        ]);

        $foto1Path = $obat->foto1;
        if ($request->hasFile('foto1')) {
            if ($foto1Path && Storage::disk('public')->exists($foto1Path)) {
                Storage::disk('public')->delete($foto1Path);
            }
            $foto1Path = $request->file('foto1')->store('obat', 'public');
        }

        $foto2Path = $obat->foto2;
        if ($request->hasFile('foto2')) {
            if ($foto2Path && Storage::disk('public')->exists($foto2Path)) {
                Storage::disk('public')->delete($foto2Path);
            }
            $foto2Path = $request->file('foto2')->store('obat', 'public');
        }

        $foto3Path = $obat->foto3;
        if ($request->hasFile('foto3')) {
            if ($foto3Path && Storage::disk('public')->exists($foto3Path)) {
                Storage::disk('public')->delete($foto3Path);
            }
            $foto3Path = $request->file('foto3')->store('obat', 'public');
        }

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'id_jenis' => $request->id_jenis,
            'harga_jual' => $request->harga_jual,
            'deskripsi_obat' => $request->deskripsi_obat,
            'foto1' => $foto1Path,
            'foto2' => $foto2Path,
            'foto3' => $foto3Path,
            'stok' => $request->stok,
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);

        // Delete images if they exist
        if ($obat->foto1 && Storage::disk('public')->exists($obat->foto1)) {
            Storage::disk('public')->delete($obat->foto1);
        }

        if ($obat->foto2 && Storage::disk('public')->exists($obat->foto2)) {
            Storage::disk('public')->delete($obat->foto2);
        }

        if ($obat->foto3 && Storage::disk('public')->exists($obat->foto3)) {
            Storage::disk('public')->delete($obat->foto3);
        }

        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
