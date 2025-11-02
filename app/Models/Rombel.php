<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $fillable = ['nama', 'tingkat_kelas_id', 'jurusan_id', 'ruang_kelas_id', 'tahun_ajaran_id', 'status'];

    public function tingkatKelas()
    {
        return $this->belongsTo(TingkatKelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function ruangKelas()
    {
        return $this->belongsTo(RuangKelas::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'rombel_siswa', 'rombel_id', 'siswa_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function siswaAktif()
    {
        return $this->belongsToMany(Siswa::class, 'rombel_siswa', 'rombel_id', 'siswa_id')
            ->wherePivot('status', true)
            ->withTimestamps();
    }

    public function moduls()
    {
        return $this->hasMany(Modul::class, 'pelajaran_id', 'tingkat_kelas_id')
            ->where('status', true);
    }
}
