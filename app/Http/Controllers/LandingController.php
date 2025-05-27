<?php

namespace App\Http\Controllers;

use App\Models\JenisObat;
use App\Models\Keranjang;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    //

    public function index()
    {

        $obatTerlaris = DB::table('detail_penjualan')
            ->select('id_obat', DB::raw('COUNT(*) as total'))
            ->groupBy('id_obat')
            ->orderByDesc('total')
            ->limit(4)
            ->pluck('total', 'id_obat');

        $obats = Obat::whereIn('id', array_keys($obatTerlaris->toArray()))
            ->get()
            ->sortByDesc(function ($obat) use ($obatTerlaris) {
                return $obatTerlaris[$obat->id];
            });

        return view('welcome', compact('obats'));
    }


    public function  category()
    {
        $jenisObats = JenisObat::all();
        $obats = Obat::all();
        return view('category', compact('jenisObats', 'obats'));
    }


    public function detailProduct($id)
    {
        $obat = Obat::with('jenisObat')->find($id);

        if (!$obat) {
            abort(404, "PRODUCT TIDAK DITEMUKAN");
        }

        $jumlah_order = 1;

        if (auth('pelanggan')->check()) {
            $user = auth('pelanggan')->user();

            $keranjang = Keranjang::where('id_pelanggan', $user->id)
                ->where('id_obat', $id)
                ->first();

            if ($keranjang) {
                $jumlah_order = $keranjang->jumlah_order;
            }
        }

        return view('product-detail', compact('obat', 'jumlah_order'));
    }


    public function contact()
    {
        return view('contact');
    }


    // authenticated
    public function addToCart(Request $request) {}
}
