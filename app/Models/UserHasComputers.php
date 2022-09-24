<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasComputers extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['id_user', 'id_computer', 'name', 'pc_name', 'section', 'location'];
}
