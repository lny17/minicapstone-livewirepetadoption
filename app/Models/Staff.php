<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['fullname', 'email', 'password', 'role'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function adoptations(){
        return $this->hasMany(Adoptations::class);
    }
}
