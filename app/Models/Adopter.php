<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname', 'email', 'phone', 'address',
    ];

    public function adoptationRequests(){
        return $this->hasMany(AdoptationRequest::class);
    }

}
