<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    protected $guarded = [];

    //Donor makes many donations(Fund)
    public function fund() {
        return $this->hasMany(Fund::class);
    }

    

}
