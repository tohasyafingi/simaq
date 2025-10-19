<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'status'];

    public function pelajaran()
    {
        return $this->hasMany(Pelajaran::class);
    }

    public function kelas()
    {
        return $this->hasMany(RuangKelas::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function modul()
    {
        return $this->hasMany(Modul::class);
    }
    public function tingkat()
    {
        return $this->belongsTo(TingkatKelas::class);
    }
}
