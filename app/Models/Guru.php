<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $fillable = ['kd_guru', 'name', 'email', 'no_hp', 'img', 'status'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function guruPelajaran()
    {
        return $this->hasMany(GuruPelajaran::class);
    }

}
