<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'thumbnail',
        'kat_berita_id',
        'status',
        'isi',
    ];
protected static function booted()
{
    static::creating(function ($berita) {
        $berita->slug = Str::slug($berita->judul);
    });

    static::updating(function ($berita) {
        $berita->slug = Str::slug($berita->judul);
    });
}
    public function kategori()
    {
        return $this->belongsTo(KatBerita::class, 'kat_berita_id');
    }
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail); // sudah full URL
        }
        return null;
    }
}
