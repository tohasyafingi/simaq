<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajarans';

    protected $fillable = ['tahun', 'semester', 'status'];

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class, 'tahun_ajaran_id');
    }

    public function guruPelajarans()
    {
        return $this->hasMany(GuruPelajaran::class, 'tahun_ajaran_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'tahun_ajaran_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'tahun_ajaran_id');
    }
    
    public function rombels()
    {
        return $this->hasMany(Rombel::class, 'tahun_ajaran_id');
    }
}
