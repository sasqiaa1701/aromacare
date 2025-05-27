<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKirimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couriers = [
            ['nama_ekspedisi' => 'jne', 'jenis_kirim' => 'regular', 'logo_ekspedisi' => 'jne.jpg'],
            ['nama_ekspedisi' => 'pos', 'jenis_kirim' => 'regular', 'logo_ekspedisi' => 'pos.png'],
            ['nama_ekspedisi' => 'tiki', 'jenis_kirim' => 'standar', 'logo_ekspedisi' => 'tiki.png'],
        ];

        foreach ($couriers as $courier) {
            DB::table('jenis_pengiriman')->insert([
                'nama_ekspedisi' => $courier['nama_ekspedisi'],
                'jenis_kirim' => $courier['jenis_kirim'],
                'logo_ekspedisi' => $courier['logo_ekspedisi'],
            ]);
        }
    }
}
