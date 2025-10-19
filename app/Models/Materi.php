<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materis';

    protected $fillable = ['guru_pelajaran_id', 'judul', 'deskripsi', 'tanggal', 'jam', 'file', 'status'];

    public function guruPelajaran()
    {
        return $this->belongsTo(GuruPelajaran::class, 'guru_pelajaran_id');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'materi_id');
    }
}