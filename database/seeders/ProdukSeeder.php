<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'nama' => 'Produk 1',
                'jenis' => 'Elektronik',
                'deskripsi' => 'Deskripsi untuk Produk 1',
                'hargajual' => 1000000.00,
                'hargabeli' => 800000.00,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Produk 2',
                'jenis' => 'Pakaian',
                'deskripsi' => 'Deskripsi untuk Produk 2',
                'hargajual' => 200000.00,
                'hargabeli' => 150000.00,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Produk 3',
                'jenis' => 'Peralatan Rumah Tangga',
                'deskripsi' => 'Deskripsi untuk Produk 3',
                'hargajual' => 300000.00,
                'hargabeli' => 250000.00,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
