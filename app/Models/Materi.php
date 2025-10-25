<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materis';

    protected $fillable = ['guru_pelajaran_id', 'rombel_id', 'judul', 'deskripsi', 'tanggal', 'jam', 'file', 'status'];

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'materi_id');
    }
    public function guruPelajaran()
    {
        return $this->belongsTo(GuruPelajaran::class);
    }

    public function rombel() 
    {
        return $this->belongsTo(Rombel::class);
    }
}
