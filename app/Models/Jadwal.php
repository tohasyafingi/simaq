<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    protected $fillable = ['hari', 'waktu_jadwal_id', 'guru_pelajaran_id', 'siswa_kelas_id', 'tahun_ajaran_id', 'status'];

    public function waktuJadwal()
    {
        return $this->belongsTo(WaktuJadwal::class, 'waktu_jadwal_id');
    }

    public function guruPelajaran()
    {
        return $this->belongsTo(GuruPelajaran::class, 'guru_pelajaran_id');
    }

    public function siswaKelas()
    {
        return $this->belongsTo(SiswaKelas::class, 'siswa_kelas_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
}
