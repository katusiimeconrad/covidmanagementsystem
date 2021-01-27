<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;
    protected $guarded = [];

    //A donation belongs to one Donor
    public function donor() {
        return $this->belongsTo(Donor::class);
    }

}
