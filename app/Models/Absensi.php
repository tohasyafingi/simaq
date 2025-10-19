<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis';

    protected $fillable = ['materi_id', 'siswa_id', 'status_kehadiran', 'status'];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}