<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = ['license_name', 'last_renewal', 'time_renewal_code', 'time_renewal_value', 'expired_date', 'history', 'description'];
    public $timestamps = true;

}
