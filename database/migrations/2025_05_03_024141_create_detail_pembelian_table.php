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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_obat')->references('id')->on('obat')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_pembelian')->references('id')->on('pembelian')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah_beli');
            $table->integer('harga_beli');
            $table->double('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
