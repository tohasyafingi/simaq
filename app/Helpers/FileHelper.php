<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileHelper
{
    /**
     * Store a non-image file using a slug-based filename while keeping original extension.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $baseName
     * @param string $disk
     * @return string
     */
    public static function storeWithSlug(UploadedFile $file, string $directory, ?string $baseName = null, string $disk = 'public'): string
    {
        $safeBase = Str::slug($baseName ?: 'file');
        $extension = $file->getClientOriginalExtension();
        $filename = $safeBase . '-' . time() . '-' . Str::random(6) . ($extension ? '.' . $extension : '');

        return $file->storeAs($directory, $filename, $disk);
    }
}
