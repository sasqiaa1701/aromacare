<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_metode_bayar')->references('id')->on('metode_bayar')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_jenis_kirim')->references('id')->on('jenis_pengiriman')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_pelanggan')->references('id')->on('pelanggan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tgl_penjualan');
            $table->string('url_resep');
            $table->double('ongkos_kirim');
            $table->double('biaya_app');
            $table->double('total_bayar');
            $table->enum('status_order', ['Menunggu Konfirmasi', 'Diproses', 'Menunggu Kurir', 'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 'Selesai']);
            $table->string('keterangan_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
