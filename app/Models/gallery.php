<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
