<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'species', 'sex', 'status', 'arrival_date'];

    public function adoptationRequests(){
        return $this->hasMany(AdoptationRequest::class);
    }
}
