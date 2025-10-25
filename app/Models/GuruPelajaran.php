<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPelajaran extends Model
{
    protected $table = 'guru_pelajarans';

    protected $fillable = ['guru_id', 'pelajaran_id', 'tahun_ajaran_id', 'status'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'guru_pelajaran_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class, 'guru_pelajaran_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'guru_pelajaran_id');
    }
    
    public function rombels()
    {
        return $this->hasMany(Rombel::class, 'tahun_ajaran_id', 'tahun_ajaran_id')
            ->where('status', 1);
    }
}
