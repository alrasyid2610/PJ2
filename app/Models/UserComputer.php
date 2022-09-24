<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComputer extends Model
{
    use HasFactory;

    protected $fillable = ['id_section', 'name', 'section', 'factory', 'email'];
    public $timestamps = true;

}
