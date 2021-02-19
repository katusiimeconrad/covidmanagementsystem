<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentUser extends Model
{
    use HasFactory;

    public function healthOfficer()
    {
        return $this->belongsTo(HealthOfficer::class);
    }
}
