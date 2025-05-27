<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    //
    public function index()
    {
        $distributors = Distributor::all();
        return view('dashboard.distributor.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        // Simpan data distributor baru
        Distributor::create([
            'nama_distributor' => $request->nama_distributor,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        // Redirect ke halaman index
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Distributor $distributor)
    {
        return view('dashboard.distributor.show', compact('distributor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distributor $distributor)
    {
        return view('dashboard.distributor.edit', compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distributor $distributor)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        // Update data distributor
        $distributor->update([
            'nama_distributor' => $request->nama_distributor,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        // Redirect ke halaman index
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distributor $distributor)
    {
        // Hapus data distributor
        $distributor->delete();

        // Redirect ke halaman index
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil dihapus!');
    }
}
