<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $primaryKey = 'id_Ulasan';

    protected $fillable = [
        'id_Masakan',
        'id_User',
        'isi_Ulasan',
    ];

    public function masakan()
    {
        return $this->belongsTo(Masakan::class, 'id_Masakan', 'id_Masakan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_User', 'id_User');
    }
}

