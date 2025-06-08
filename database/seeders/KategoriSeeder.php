<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori; // Pastikan Anda mengimpor model Kategori

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat kategori 'makanan' jika belum ada
        Kategori::firstOrCreate([
            'nama' => 'makanan'
        ]);

        // Buat kategori 'minuman' jika belum ada
        Kategori::firstOrCreate([
            'nama' => 'minuman'
        ]);
    }
}
