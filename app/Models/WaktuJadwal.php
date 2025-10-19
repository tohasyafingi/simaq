<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuJadwal extends Model
{
    protected $table = 'waktu_jadwals';

    protected $fillable = ['jam_mulai', 'jam_selesai'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'waktu_jadwal_id');
    }
}
