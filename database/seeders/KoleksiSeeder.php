<?php

namespace Database\Seeders;

use App\Models\KoleksiPribadi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KoleksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pertama = KoleksiPribadi::create([
            'NamaKoleksi' => 'reminisce',
            'userid' => 3,
        ]);
        $photoPath = 'storage/koleksi/cover/reminisce.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/koleksi/cover/reminisce.jpg')));

        $pertama->ImgKoleksi = $photoPath;
        $pertama->save();

        $kedua = KoleksiPribadi::create([
            'NamaKoleksi' => 'fantasies',
            'userid' => 3,
        ]);
        $photoPath = 'storage/koleksi/cover/fantasies.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/koleksi/cover/fantasies.jpg')));

        $kedua->ImgKoleksi = $photoPath;
        $kedua->save();

        $ketiga = KoleksiPribadi::create([
            'NamaKoleksi' => 'Historyyy',
            'userid' => 3,
        ]);
        $photoPath = 'storage/koleksi/cover/history.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/koleksi/cover/history.jpg')));

        $ketiga->ImgKoleksi = $photoPath;
        $ketiga->save();


        KoleksiPribadi::find(1)->buku()->attach([1, 2, 3]); 
        KoleksiPribadi::find(2)->buku()->attach([6, 9, 8]); 
        KoleksiPribadi::find(3)->buku()->attach([4, 5, 7]); 
    }
}
