<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peminjaman::create([
            'userid' => 3,
            'BukuID' => 3,
            'TanggalPeminjaman' => '2024-01-16 12:55:47',
            'TanggalPengembalian' => '2024-01-17 12:55:47',
            'StatusPeminjaman' => 'Masa Aktif',
        ]);
    }
}
