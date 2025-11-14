<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoptations extends Model
{
   protected $fillable = ['adoptation_request_id', 'adoptation_date', 'staff_id'];

public function adoptationRequest(){
    return $this->belongsTo(AdoptationRequest::class, 'adoptation_request_id');
}


    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}

