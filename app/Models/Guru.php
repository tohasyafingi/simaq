<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $fillable = ['kd_guru', 'name', 'email', 'no_hp', 'img', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function guruPelajarans()
    {
        return $this->hasMany(GuruPelajaran::class, 'guru_id', 'id');
    }

    public function pelajarans()
    {
        return $this->belongsToMany(Pelajaran::class, 'guru_pelajarans')
            ->withPivot('tahun_ajaran_id', 'status');
    }
    public function rombels()
    {
        return $this->hasManyThrough(
            Rombel::class,
            GuruPelajaran::class,
            'guru_id',
            'tahun_ajaran_id',
            'id',
            'tahun_ajaran_id'
        )->where('rombels.status', 1);
    }
}
