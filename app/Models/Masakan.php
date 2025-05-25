<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masakan extends Model
{
    protected $primaryKey = 'id_Masakan';

    protected $fillable = [
        'nama_Masakan',
        'gambar_Masakan',
        'deskripsi_Resep',
        'bahan_Memasak',
        'detail_Resep',
        'kategori_Masakan',
    ];

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'id_Masakan', 'id_Masakan');
    }
// Di Masakan.php
public function simpans()
{
    return $this->hasMany(Simpan::class, 'id_Masakan');
}

   
}
