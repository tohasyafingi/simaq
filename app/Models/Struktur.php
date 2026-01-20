<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Struktur extends Model
{
    protected $table = 'struktur';
    protected $fillable = ['jabatan', 'urutan', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function validUsers()
    {
        return User::whereIn('role', ['admin','guru','bendahara','karyawan'])->get();
    }
}

