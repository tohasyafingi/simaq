<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class KaryaIlmiah extends Model
{
    protected $fillable = [
        'judul',
        'thumbnail',
        'author',
        'kat_karya_ilmiah_id',
        'status',
        'isi',
    ];
protected static function booted()
{
    static::creating(function ($karya_ilmiah) {
        $karya_ilmiah->slug = Str::slug($karya_ilmiah->judul);
    });

    static::updating(function ($karya_ilmiah) {
        $karya_ilmiah->slug = Str::slug($karya_ilmiah->judul);
    });
    static::saved(function ($karya) {
        Cache::forget('seo:sitemap.xml');
    });
    static::deleted(function ($karya) {
        Cache::forget('seo:sitemap.xml');
    });
}
    public function kategori()
    {
        return $this->belongsTo(KatKaryaIlmiah::class, 'kat_karya_ilmiah_id');
    }
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail); // sudah full URL
        }
        return null;
    }
}