<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'email',
        'no_hp',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'kk',
        'akta',
        'ijazah_terakhir',
        'img',
        'status'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelasAktif()
    {
        return $this->hasOne(SiswaKelas::class)->where('status', 'aktif');
    }

    public function kelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
    
    public function rombels()
    {
        return $this->belongsToMany(Rombel::class, 'rombel_siswa', 'siswa_id', 'rombel_id')
            ->withPivot('status')
            ->withTimestamps();
    }
}
