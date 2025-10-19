<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKelas extends Model
{
    protected $table = 'siswa_kelas';

    protected $fillable = [
        'siswa_id', 'ruang_kelas_id', 'tingkat_kelas_id', 'jurusan_id', 'tahun_ajaran_id', 'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function ruangKelas()
    {
        return $this->belongsTo(RuangKelas::class, 'ruang_kelas_id');
    }

    public function tingkatKelas()
    {
        return $this->belongsTo(TingkatKelas::class, 'tingkat_kelas_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'siswa_kelas_id');
    }
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeLulus($query)
    {
        return $query->where('status', 'lulus');
    }
}
