<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\JenisObatController;
use App\Http\Controllers\JenisPengirimanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfNotPelanggan;
use Illuminate\Support\Facades\Route;


Route::get("/login", [AuthController::class, "login"])->name('login');
Route::post("/login", [AuthController::class, "loginPost"]); 


Route::middleware(['auth'])->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name('dashboard');
    Route::resource("/jenis-obat", JenisObatController::class);
    Route::resource("/jenis-pengiriman", JenisPengirimanController::class);
    Route::resource("/metode-bayar", MetodePembayaranController::class);
    Route::resource("/obat", ObatController::class);
    Route::resource("/distributor", DistributorController::class);
    Route::resource("/users", UserController::class);
    Route::resource("/pelanggan", PelangganController::class);
    Route::get("/logout", [AuthController::class, "logoutAdmin"]);


    Route::get('/laporan/pembelian', [PembelianController::class, "laporan"])->name('laporan.pembelian.index');
    Route::get('/laporan/pembelian/{id}', [PembelianController::class, "laporanShow"])->name('laporan.pembelian.show');
    Route::get('/laporan/pembelian/{id}/print', [PembelianController::class, "printNota"])->name('laporan.pembelian.print');

    Route::delete('/laporan/pembelian/{id}/delete', [PembelianController::class, "destroy"])->name('laporan.pembelian.destroy');

    Route::get("/transaksi/pembelian", [PembelianController::class, "index"])->name('pembelian.index');
    Route::post("/transaksi/pembelian", [PembelianController::class, "store"])->name('pembelian.store');

 
    Route::get("/transaksi/penjualan", [PenjualanController::class, "index"])->name('penjualan.index');
    Route::get("/transaksi/penjualan/{id}", [PenjualanController::class, "show"])->name('penjualan.show');
    Route::delete("/transaksi/penjualan/{id}", [PenjualanController::class, "destroy"])->name('penjualan.destroy');

    Route::put('/penjualan/{id}/update-status', [PenjualanController::class, 'updateStatus'])->name('penjualan.update_status');


    Route::get('/laporan/penjualan', [PenjualanController::class, "laporan"])->name('laporan.penjualan.index');
    Route::get('/laporan/penjualan/{id}/print', [PenjualanController::class, "print"])->name('laporan.penjualan.print');

    Route::get('/profile', [ProfileController::class, "index"])->name('profile.index');
    Route::post('/profile', [ProfileController::class, "update"])->name('profile.admin.update');




});

Route::get("/", [LandingController::class, "index"])->name('landing.index');
Route::get("/products/{id}", [LandingController::class, "detailProduct"])->name('landing.product.detail');

Route::get("/category", [LandingController::class, "category"])->name('landing.category');
Route::get("/contact", [LandingController::class, "contact"])->name('landing.contact');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');


Route::middleware(RedirectIfNotPelanggan::class)->group(function () {
    Route::get('guest/profile', [AuthenticatedController::class, "profile"])->name('pelanggan.profile');
    Route::post('/product/{id}/addToCart', [AuthenticatedController::class, 'addToCart'])->name('pelanggan.addToCart');

    Route::post("guest/profile/{id}", [AuthenticatedController::class, "updateProfile"])->name('profile.update');

    Route::get('cart', [AuthenticatedController::class, "cart"])->name('pelanggan.cart');
    Route::get('checkout', [AuthenticatedController::class, "checkout"])->name('pelanggan.checkout');
    Route::post('checkout/{id}/cancel', [AuthenticatedController::class, "cancel"])->name('pelanggan.checkout.cancel');
    Route::get('/guest/logout', [AuthenticatedController::class, "logout"])->name('guest.logout');
    Route::post('/checkout/resep-pelanggan/{id}' , [CheckoutController::class , "addResep"])->name('pelanggan.checkout.resep');

});

Route::get('/guest/login', [AuthController::class, "loginGuest"])->name('login.guest');
Route::post('/guest/login', [AuthController::class, "loginGuestStore"])->name('login.pelanggan.store');

Route::get('/guest/register', [AuthController::class, "registerGuest"])->name('login.guest.register');
Route::post('/guest/register', [AuthController::class, "registerGuestStore"])->name('register.pelanggan.store');
