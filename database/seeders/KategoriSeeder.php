<?php

namespace Database\Seeders;

use App\Models\KategoriBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriBuku::create([
            'NamaKategori' => 'Fiksi',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Nonfiksi',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Aksi',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Misteri',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Ekonomi',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Ensiklopedia',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Fiksi',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Humor',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Inspirasi',
        ]);
        KategoriBuku::create([
            'NamaKategori' => 'Sejarah',
        ]);
    }
}
