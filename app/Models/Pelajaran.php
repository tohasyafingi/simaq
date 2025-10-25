<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;

    protected $fillable = ['kd_pelajaran', 'nama', 'jurusan_id', 'tingkat_kelas_id', 'status'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
    public function tingkatKelas()
    {
        return $this->belongsTo(TingkatKelas::class, 'tingkat_kelas_id');
    }

    public function guruPelajarans()
    {
        return $this->hasMany(GuruPelajaran::class);
    }
}
