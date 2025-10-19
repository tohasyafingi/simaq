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
}
