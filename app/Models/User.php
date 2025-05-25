<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $primaryKey = 'id_User';

    protected $fillable = [
        'username',
        'email',
        'password',
        'foto_Profil',
        'bio',
    ];

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'username', 'id_User');
    }

    

}