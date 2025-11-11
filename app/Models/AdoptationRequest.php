<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdoptationRequest extends Model
{
    protected $table = 'adoptation_requests';
    protected $fillable = ['pet_id', 'adopter_id', 'request_date', 'status'];

    public function pet(){
        return $this->belongsTo(Pet::class);
    }

    public function adopter(){
        return $this->belongsTo(Adopter::class);
    }

    public function adoptations(){
        return $this->hasMany(Adoptations::class);
    }
}
