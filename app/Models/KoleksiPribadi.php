<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KoleksiPribadi extends Model
{
    use HasFactory;
    protected $table = "koleksipribadi";

    protected $primaryKey = "KoleksiID";
    protected $foreignKey = "KoleksiID";

    protected $fillable = [
        'NamaKoleksi',
        'userid',
        'ImgKoleksi'
    ];


    // Relation to table/model KategoriBuku
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    // Relation to table/model KategoriBuku
    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'koleksi_pribadi_buku', 'KoleksiPribadiID', 'BukuID');
    }
}
