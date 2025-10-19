<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TataUsaha extends Model
{
    use HasFactory;
    protected $fillable = ['kd_tu', 'name', 'email', 'no_hp', 'img', 'status'];
}
