<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    //
    /**
     * Menampilkan daftar pelanggan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pelanggan = Pelanggan::paginate(); // Mengambil semua data pelanggan
        return view('dashboard.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Menampilkan form untuk menambah pelanggan baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.pelanggan.create');
    }

    /**
     * Menyimpan pelanggan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'katakunci' => 'required|string|min:8',
            'no_telp' => 'required|string|max:20',
            'alamat1' => 'required|string',
            'kota1' => 'required|string',
            'provinsi1' => 'required|string',
            'kodepos1' => 'required|string|max:10',
            'alamat2' => 'nullable|string',
            'kota2' => 'nullable|string',
            'provinsi2' => 'nullable|string',
            'kodepos2' => 'nullable|string|max:10',
            'alamat3' => 'nullable|string',
            'kota3' => 'nullable|string',
            'provinsi3' => 'nullable|string',
            'kodepos3' => 'nullable|string|max:10',
            'url_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hash password
        $validated['katakunci'] = Hash::make($validated['katakunci']);

        // Upload foto KTP
        if ($request->hasFile('url_ktp')) {
            $ktp = $request->file('url_ktp');
            $ktpName = 'ktp_' . time() . '.' . $ktp->getClientOriginalExtension();
            $ktp->move(public_path('uploads/pelanggan'), $ktpName);
            $validated['url_ktp'] = 'uploads/pelanggan/' . $ktpName;
        }

        // Upload foto pelanggan (optional)
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = 'foto_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/pelanggan'), $fotoName);
            $validated['foto'] = 'uploads/pelanggan/' . $fotoName;
        }

        // Simpan data ke database
        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }


    /**
     * Menampilkan form untuk mengedit pelanggan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('dashboard.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Memperbarui data pelanggan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email,' . $pelanggan->id,
            'katakunci' => 'nullable|string|min:8', // Bisa dikosongkan jika tidak ingin ganti password
            'no_telp' => 'required|string|max:20',
            'alamat1' => 'required|string',
            'kota1' => 'required|string',
            'provinsi1' => 'required|string',
            'kodepos1' => 'required|string|max:10',
            'alamat2' => 'nullable|string',
            'kota2' => 'nullable|string',
            'provinsi2' => 'nullable|string',
            'kodepos2' => 'nullable|string|max:10',
            'alamat3' => 'nullable|string',
            'kota3' => 'nullable|string',
            'provinsi3' => 'nullable|string',
            'kodepos3' => 'nullable|string|max:10',
            'url_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika password diisi, hash dan update
        if (!empty($validated['katakunci'])) {
            $validated['katakunci'] = Hash::make($validated['katakunci']);
        } else {
            unset($validated['katakunci']);
        }

        // Upload dan simpan KTP jika ada
        if ($request->hasFile('url_ktp')) {
            $ktp = $request->file('url_ktp');
            $ktpName = 'ktp_' . time() . '.' . $ktp->getClientOriginalExtension();
            $ktp->move(public_path('uploads/pelanggan'), $ktpName);
            $validated['url_ktp'] = 'uploads/pelanggan/' . $ktpName;
        }

        // Upload dan simpan foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = 'foto_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/pelanggan'), $fotoName);
            $validated['foto'] = 'uploads/pelanggan/' . $fotoName;
        }

        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }


    /**
     * Menghapus pelanggan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        // Delete foto if it exists
        if (file_exists(public_path($pelanggan->foto))) {
            unlink(public_path($pelanggan->foto));
        }
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
