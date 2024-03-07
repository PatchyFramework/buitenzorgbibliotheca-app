<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BukuSeeder::class,
            KategoriSeeder::class,
            UserSeeder::class,
            KategoriBukuRelasiSeeder::class,
            KoleksiSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}
