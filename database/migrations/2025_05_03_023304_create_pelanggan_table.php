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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('email');
            $table->string('katakunci');
            $table->string('no_telp');
            $table->string('alamat1');
            $table->string('kota1');
            $table->string('provinsi1');
            $table->string('kodepos1');
            $table->string('alamat2');
            $table->string('kota2');
            $table->string('provinsi2');
            $table->string('kodepos2');
            $table->string('alamat3');
            $table->string('kota3');
            $table->string('provinsi3');
            $table->string('kodepos3');
            $table->string('url_ktp');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
