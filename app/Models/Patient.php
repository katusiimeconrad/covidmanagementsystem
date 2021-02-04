<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];


    //Patient is added by one health officer
    public function healthOfficer() {
        return $this->belongsTo(HealthOfficer::class);
    }

    //Patient is added to one hospital
    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }



}
