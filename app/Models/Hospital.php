<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hospital extends Model
{
    use HasFactory;
    protected $guarded = [];

    //A hospital is in one district
    public function district() {
        return $this->BelongsTo(District::class);
    }

    //Hospital has many health officers
    public function healthofficer() {
        return $this->hasMany(HealthOfficer::class);

    }



}
