<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    protected $table = 'gallery_details';

    protected $fillable = [
        'gallery_id',
        'image_path',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
