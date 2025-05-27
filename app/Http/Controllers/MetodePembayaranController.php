<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MetodePembayaranController extends Controller
{
    //
    public function index()
    {
        $metodeBayar = MetodeBayar::all();
        return view('dashboard.metode-bayar.index', compact('metodeBayar'));
    }

    public function create()
    {
        return view('dashboard.metode-bayar.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'tempat_bayar'      => 'required|string|max:255',
            'no_rekening'       => 'required|string|max:255',
            'url_logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('url_logo')) {
            $validated['url_logo'] = $request->file('url_logo')->store('metode_bayar', 'public');
        }

        MetodeBayar::create($validated);

        return redirect()->route('metode-bayar.index')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);
        return view('dashboard.metode-bayar.edit', compact('metodeBayar'));
    }

    public function update(Request $request, $id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);

        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'tempat_bayar'      => 'required|string|max:255',
            'no_rekening'       => 'required|string|max:255',
            'url_logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('url_logo')) {
            // Delete old logo if exists
            if ($metodeBayar->url_logo && Storage::disk('public')->exists($metodeBayar->url_logo)) {
                Storage::disk('public')->delete($metodeBayar->url_logo);
            }

            $validated['url_logo'] = $request->file('url_logo')->store('metode_bayar', 'public');
        }

        $metodeBayar->update($validated);

        return redirect()->route('metode-bayar.index')->with('success', 'Metode pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);

        if ($metodeBayar->url_logo && Storage::disk('public')->exists($metodeBayar->url_logo)) {
            Storage::disk('public')->delete($metodeBayar->url_logo);
        }

        $metodeBayar->delete();

        return redirect()->route('metode-bayar.index')->with('success', 'Metode pembayaran berhasil dihapus.');
    }
}
