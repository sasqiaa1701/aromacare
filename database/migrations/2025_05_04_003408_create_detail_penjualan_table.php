<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')->references('id')->on('penjualan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_obat')->references('id')->on('obat')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah_beli');
            $table->double('harga_beli');
            $table->double('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
