<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'districtName',
        'region'
    ];
    //A District has many hospitals
    public function hospital() {
        return $this->hasMany(Hospital::class);
        //return $this->hasMany('App\Models\Hospital');   <-----Alternatively;
    }

}
