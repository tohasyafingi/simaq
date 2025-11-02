<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'pelajaran_id', 'link', 'file', 'status'];

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
        public function rombels()
    {
        return $this->hasManyThrough(
            \App\Models\Rombel::class,
            \App\Models\Pelajaran::class,
            'id',           // foreign key Pelajaran di Modul (pelajaran_id)
            'pelajaran_id', // foreign key Pelajaran di Rombel? (sesuaikan)
            'pelajaran_id', // local key Modul
            'id'            // local key Pelajaran
        );
    }
}
