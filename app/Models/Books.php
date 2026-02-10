<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'image', 'description', 'file', 'link', 'slug', 'status'];

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
        static::saved(function ($model) {
            Cache::forget('seo:sitemap.xml');
        });

        static::deleted(function ($model) {
            Cache::forget('seo:sitemap.xml');
        });
    }
}
