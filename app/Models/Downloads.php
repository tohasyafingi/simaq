<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Downloads extends Model
{
    use HasFactory;
    
    protected $fillable = ['judul', 'image', 'description', 'file', 'status'];
}
