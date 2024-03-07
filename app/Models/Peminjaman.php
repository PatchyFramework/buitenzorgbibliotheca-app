<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "peminjaman";

    protected $primaryKey = "PeminjamanID";
    protected $foreignKey = "PeminjamanID";

    protected $fillable = [
        'userid',
        'BukuID',
        'TanggalPeminjaman',
        'TanggalPengembalian',
        'StatusPeminjaman',
        'Denda',
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
