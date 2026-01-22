<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'judul',
        'deskripsi',
        'thumbnail',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(GalleryDetail::class);
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget('seo:sitemap.xml');
        });

        static::deleted(function ($model) {
            Cache::forget('seo:sitemap.xml');
        });
    }
}
