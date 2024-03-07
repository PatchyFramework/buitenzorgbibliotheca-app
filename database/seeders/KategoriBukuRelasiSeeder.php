<?php

namespace Database\Seeders;

use App\Models\KategoriBukuRelasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriBukuRelasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriBukuRelasi::create([
            'KategoriID' => 1,
            'BukuID' => 1,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 2,
            'BukuID' => 2,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 3,
            'BukuID' => 3,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 4,
            'BukuID' => 4,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 5,
            'BukuID' => 5,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 6,
            'BukuID' => 6,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 7,
            'BukuID' => 7,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 8,
            'BukuID' => 8,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 9,
            'BukuID' => 9,
        ]);
        KategoriBukuRelasi::create([
            'KategoriID' => 10,
            'BukuID' => 10,
        ]);
    }
}
