<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\ImageService;

class ImageHelper
{
    /**
     * Convenience wrapper to store uploaded file as optimized webp.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $baseName
     * @param string $disk
     * @return string
     */
    public static function storeOptimized(UploadedFile $file, string $directory, ?string $baseName = null, string $disk = 'public'): string
    {
        return ImageService::storeAsWebp($file, $directory, $baseName, $disk);
    }

    /**
     * Replace an existing stored image by deleting the old one and storing the new optimized webp.
     *
     * @param string|null $oldPath
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $baseName
     * @param string $disk
     * @return string
     */
    public static function replaceOptimized(?string $oldPath, UploadedFile $file, string $directory, ?string $baseName = null, string $disk = 'public'): string
    {
        return ImageService::replaceWithWebp($oldPath, $file, $directory, $baseName, $disk);
    }

    public static function deletePath(?string $path, string $disk = 'public'): bool
    {
        return ImageService::deletePath($path, $disk);
    }

    /**
     * Build a public URL for a stored image path.
     */
    public static function url(?string $path, string $disk = 'public'): ?string
    {
        if (!$path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        return Storage::disk($disk)->url($path);
    }

    /**
     * Alias for thumbnail image URL.
     */
    public static function thumbnailUrl(?string $path, string $disk = 'public'): ?string
    {
        return self::url($path, $disk);
    }

    public static function deleteUnusedFromHtml(?string $oldHtml, ?string $newHtml, string $disk = 'public', string $prefix = 'summernote/'): void
    {
        $oldPaths = self::extractStoragePathsFromHtml($oldHtml, $prefix);
        $newPaths = self::extractStoragePathsFromHtml($newHtml, $prefix);

        $toDelete = array_diff($oldPaths, $newPaths);
        if (empty($toDelete)) {
            return;
        }

        foreach ($toDelete as $path) {
            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }

    private static function extractStoragePathsFromHtml(?string $html, string $prefix): array
    {
        if (!$html) {
            return [];
        }

        $matches = [];
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $matches);

        $paths = [];
        foreach ($matches[1] ?? [] as $src) {
            $path = $src;

            $parsed = parse_url($src);
            if (!empty($parsed['path'])) {
                $path = $parsed['path'];
            }

            $path = ltrim($path, '/');
            if (Str::startsWith($path, 'storage/')) {
                $path = substr($path, strlen('storage/'));
            }

            $path = ltrim($path, '/');
            if ($prefix && !Str::startsWith($path, $prefix)) {
                continue;
            }

            $paths[] = $path;
        }

        return array_values(array_unique($paths));
    }
}
