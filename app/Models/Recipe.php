<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // Tambahkan field yang dapat diisi secara massal
    protected $fillable = [
        'title', 'category', 'origin', 'image', 'time', 'type'
    ];
}
