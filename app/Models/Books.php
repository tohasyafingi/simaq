<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Books extends Model
{
    use HasFactory;
    
    protected $fillable = ['judul', 'image', 'description', 'file', 'status'];

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
