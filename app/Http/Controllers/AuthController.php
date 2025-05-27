<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view("login");
    }


    public function loginPost(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function loginGuest()
    {
        return view('login-pelanggan');
    }


    public function loginGuestStore(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        // Check if the user exists and the password matches
        if ($pelanggan && Hash::check($request->password, $pelanggan->katakunci)) {
            Auth::guard('pelanggan')->login($pelanggan);

            $request->session()->regenerate();

            return redirect()->intended('/');
        } else {
            // If authentication fails, redirect back with an error
            return redirect()->back()->with('error', 'Ops, harap periksa email atau password Anda');
        }
    }


    public function registerGuest()
    {
        return view('register-pelanggan');
    }

    public function registerGuestStore(Request $request)
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

        $validated['katakunci'] = Hash::make($validated['katakunci']);

        if ($request->hasFile('url_ktp')) {
            $ktp = $request->file('url_ktp');
            $ktpName = 'ktp_' . time() . '.' . $ktp->getClientOriginalExtension();
            $ktp->move(public_path('uploads/pelanggan'), $ktpName);
            $validated['url_ktp'] = 'uploads/pelanggan/' . $ktpName;
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = 'foto_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/pelanggan'), $fotoName);
            $validated['foto'] = 'uploads/pelanggan/' . $fotoName;
        }

        Pelanggan::create($validated);
        return redirect()->route('login.guest')->with('success', 'berhasil registrasi silahkan login');
    }


    public function logoutAdmin()
    {
        Auth::logout();
        return redirect()->to('/login')->with('success', 'berhasil logout');
    }
}
