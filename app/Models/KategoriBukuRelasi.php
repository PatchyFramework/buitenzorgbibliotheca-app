<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBukuRelasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "kategoribuku_relasi";
    protected $foreignKey = "KategoriBukuID";
    protected $primaryKey = "KategoriBukuID";

    protected $fillable = [
        'KategoriID',
        'BukuID',
    ];

    public function kategoriBuku()
    {
        return $this->belongsTo(KategoriBuku::class, 'KategoriID');
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }
}
