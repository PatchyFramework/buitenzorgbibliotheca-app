<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UlasanBuku extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "ulasanbuku";

    protected $primaryKey = "UlasanID";
    protected $foreignKey = "UlasanID";

    protected $fillable = [
        'userid',
        'BukuID',
        'Ulasan',
        'Rating',
    ];


    // Relation to table/model KategoriBuku
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    // Relation to table/model KategoriBuku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }
}
