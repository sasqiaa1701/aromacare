<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'jabatan' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'apoteker',
            'email' => 'apoteker@example.com',
            'jabatan' => 'apoteker',
        ]);
        User::factory()->create([
            'name' => 'karyawan',
            'email' => 'karyawan@example.com',
            'jabatan' => 'karyawan',
        ]);
        User::factory()->create([
            'name' => 'kasir',
            'email' => 'kasir@example.com',
            'jabatan' => 'kasir',
        ]);
        User::factory()->create([
            'name' => 'pemilik',
            'email' => 'pemilik@example.com',
            'jabatan' => 'pemilik',
        ]);

        $this->call([JenisKirimSeeder::class, JenisObatSeeder::class]);
    }
}
