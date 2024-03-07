<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "buku";

    protected $foreignKey = "BukuID";
    protected $primaryKey = 'BukuID';

    protected $fillable = [
        'Barcode',
        'Judul',
        'Penulis',
        'Penerbit',
        'TahunTerbit',
        'Synopsis',
        'Stock',
        'StatusKetersediaan',
        'ImgBuku',
    ];
}
