<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthOfficer extends Model
{
    use HasFactory;
    protected $guarded = [];

    //A health officer works at a Hospital
    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }

    //A Health officer works on many Patients
    public function patient() {
        return $this->hasMany(Patient::class);
    }

}
