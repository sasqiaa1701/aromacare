<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisObat = [
            [
                'jenis' => 'Obat Bebas',
                'deskripsi_jenis' => 'Obat yang dijual bebas dan tanpa resep dokter.',
                'image_url' => 'vitamin.jpg'
            ],
            [
                'jenis' => 'Obar Bebas Terbatas',
                'deskripsi_jenis' => 'Obat yang dapat dibeli secara bebas tanpa menggunakan resep dokter, namun mempunyai peringatan khusus saat menggunakannya.',
                'image_url' => 'vitamin.jpg'
            ],
            [
                'jenis' => 'Obat Keras',
                'deskripsi_jenis' => 'Obat yang harus menggunakan resep dokter.',
                'image_url' => 'vitamin.jpg'
            ],
            [
                'jenis' => 'Obat Fitofarmaka',
                'deskripsi_jenis' => 'Obat herbal atau obat tradisional dari bahan alami.',
                'image_url' => 'vitamin.jpg'
            ],
            [
                'jenis' => 'Vitamin & Suplemen',
                'deskripsi_jenis' => 'Untuk menjaga daya tahan tubuh.',
                'image_url' => 'vitamin.jpg'
            ]
        ];

        foreach ($jenisObat as $obat) {
            DB::table('jenis_obat')->insert([
                'jenis' => $obat['jenis'],
                'deskripsi_jenis' => $obat['deskripsi_jenis'],
                'image_url' => $obat['image_url']
            ]);
        }
    }
}
