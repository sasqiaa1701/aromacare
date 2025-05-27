<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //


    public function index()
    {
        $obats = Obat::count();
        $pelanggans = Pelanggan::count();
        $users = User::count();
        $penjualans = Penjualan::count();

        $penjualanTerbaru = Penjualan::latest('created_at')->take(5)->get();


        return view("dashboard.index", compact('obats', 'pelanggans', 'users', 'penjualans' , 'penjualanTerbaru'));
    }
}
