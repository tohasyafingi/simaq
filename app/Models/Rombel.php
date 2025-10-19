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
}
