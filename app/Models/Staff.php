<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'email', 'password', 'role'];

    public function adoptations(){
        return $this->hasMany(Adoptations::class);
    }
}
