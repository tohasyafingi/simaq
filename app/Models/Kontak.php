<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontaks';

    protected $fillable = [
        'alamat',
        'telepon',
        'email',
        'google_map_embed',
        'message_name',
        'message_email',
        'message_subject',
        'message_content',
        'facebook',
        'twitter',
        'instagram',
        'tiktok',
        'youtube',
        'about',
        'copyright',
    ];
}
