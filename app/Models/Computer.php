<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = ['pc_name', 'processor', 'os', 'ram', 'hdd', 'ip', 'ms_office', 'antivirus', 'wsus', 'user_login', 'brand', 'usage_type', 'location', 'date_fa', 'no_fa', 'edp_no_fa'];
    public $timestamps = true;
}
