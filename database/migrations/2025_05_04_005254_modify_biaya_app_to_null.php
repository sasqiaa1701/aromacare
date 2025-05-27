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
        Schema::table('penjualan', function (Blueprint $table) {
            //
            $table->double('biaya_app')->nullable()->change();
            $table->double('total_bayar')->nullable()->change();
            $table->string('url_resep')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->double('biaya_app')->nullable(false)->change();
            $table->double('total_bayar')->nullable(false)->change();
            $table->string('url_resep')->nullable(false)->change();
        });
    }
};
