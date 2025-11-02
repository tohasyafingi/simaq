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

        public function user()
    {
        return $this->hasOne(User::class, 'siswa_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
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
    public function isInAnyRombel()
    {
        return $this->rombels()->exists();
    }

    public function moduls()
    {
        return $this->hasManyThrough(
            Modul::class, // model tujuan
            Rombel::class, // model perantara
            'id', // foreign key Rombel di modul? → kita sesuaikan
            'pelajaran_id', // foreign key modul ke pelajaran
            'id', // local key siswa_id di pivot
            'id' // local key Rombel
        );
    }
}
