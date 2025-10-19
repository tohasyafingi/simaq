<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatKelas extends Model
{
    use HasFactory;

    protected $table = 'tingkat_kelas';

    protected $fillable = ['tingkat','urutan', 'status'];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'tingkat_id');
    }

    public function pelajaran()
    {
        return $this->hasMany(Pelajaran::class, 'tingkat_id');
    }

    public function ruangKelas()
    {
        return $this->hasMany(RuangKelas::class, 'tingkat_id');
    }

    public function modul()
    {
        return $this->hasMany(Modul::class, 'tingkat_id');
    }
}
