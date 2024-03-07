<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBuku extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "kategoribuku";

    protected $primaryKey = "KategoriID";
    protected $foreignKey = "KategoriID";

    protected $fillable = [
        'NamaKategori',
    ];
}
