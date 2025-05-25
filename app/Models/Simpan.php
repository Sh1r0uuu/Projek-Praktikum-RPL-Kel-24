<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpan extends Model
{
    protected $table = 'simpans';
    protected $primaryKey = 'id_Simpan';

    protected $fillable = [
        'id_User',
        'id_Masakan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_User', 'id_User');
    }

    public function masakan()
    {
        return $this->belongsTo(Masakan::class, 'id_Masakan', 'id_Masakan');
    }
}
