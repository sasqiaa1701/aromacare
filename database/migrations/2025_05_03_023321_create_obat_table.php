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
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->foreignId('id_jenis')->references('id')->on('jenis_obat')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('harga_jual');
            $table->text('deskripsi_obat');
            $table->string('foto1');
            $table->string('foto2');
            $table->string('foto3');
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
