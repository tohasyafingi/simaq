<?php

namespace App\Helpers;

use App\Models\Profiles;

class SeoHelper
{
    /**
     * Resolve an image URL for SEO/OG fallbacks.
     * Accepts a full URL or a storage relative path (stored in DB).
     */
    public static function image(?string $image = null): string
    {
        // If already a valid URL, return as-is
        if (! empty($image) && filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        // If image is a storage relative path
        if (! empty($image) && file_exists(storage_path('app/public/' . $image))) {
            return asset('storage/' . $image);
        }

        // Try site profile image
        $site = Profiles::where('type', 'site')->first();
        if ($site && ! empty($site->image) && file_exists(storage_path('app/public/' . $site->image))) {
            return asset('storage/' . $site->image);
        }

        // Final fallback
        return asset('assets/og-image.png');
    }
}
