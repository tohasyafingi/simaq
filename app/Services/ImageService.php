<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;

class ImageService
{
    /**
     * Get the Intervention ImageManager instance.
     */
    private static function manager(): ImageManager
    {
        if (extension_loaded('imagick')) {
            return new ImageManager(new ImagickDriver());
        }
        return new ImageManager(new GdDriver());
    }

    /**
     * Process an uploaded image: resize to max 1920px, set quality 70, convert to webp and store.
     *
     * @param UploadedFile $file
     * @param string $directory e.g. 'images/books'
     * @param string|null $baseName base name from slug/judul
     * @param string $disk Storage disk name (default: public)
     * @return string Stored relative path (e.g. 'images/books/abcd.webp')
     */
    public static function storeAsWebp(UploadedFile $file, string $directory, ?string $baseName = null, string $disk = 'public'): string
    {
        // Ensure directory doesn't start or end with slash
        $directory = trim($directory, '/');

        // Create a safe filename based on provided base name or original name
        $originalBase = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeBase = Str::slug($baseName ?: $originalBase ?: 'image');

        $filename = $safeBase . '-' . time() . '-' . Str::random(6) . '.webp';
        $path = $directory . '/' . $filename;

        // Create Intervention image instance
        $img = self::manager()->read($file->getRealPath());

        // Resize: constrain to max 1920 width/height while keeping aspect ratio and preventing upsize
        $img->scaleDown(1920, 1920);

        // Encode to webp with quality 70
        $encoded = $img->toWebp(70);

        // Store using Storage facade
        Storage::disk($disk)->put($path, (string) $encoded);

        return $path;
    }

    /**
     * Process an existing local image path and store as webp with the same rules.
     *
     * @param string $localPath filesystem path to image
     * @param string $directory
     * @param string $disk
     * @return string
     */
    public static function storeLocalAsWebp(string $localPath, string $directory, ?string $baseName = null, string $disk = 'public'): string
    {
        $img = self::manager()->read($localPath);

        $img->scaleDown(1920, 1920);

        $encoded = $img->toWebp(70);

        $originalBase = pathinfo($localPath, PATHINFO_FILENAME);
        $safeBase = Str::slug($baseName ?: $originalBase ?: 'image');
        $filename = $safeBase . '-' . time() . '-' . Str::random(6) . '.webp';
        $path = trim($directory, '/') . '/' . $filename;

        Storage::disk($disk)->put($path, (string) $encoded);

        return $path;
    }

    /**
     * Replace an existing stored image by deleting the old path (if exists)
     * and storing the new uploaded file as webp.
     *
     * @param string|null $oldPath
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string New stored path
     */
    public static function replaceWithWebp(?string $oldPath, UploadedFile $file, string $directory, ?string $baseName = null, string $disk = 'public'): string
    {
        if ($oldPath && Storage::disk($disk)->exists($oldPath)) {
            try {
                Storage::disk($disk)->delete($oldPath);
            } catch (\Exception $e) {
                // ignore delete errors, proceed to store new file
            }
        }

        return self::storeAsWebp($file, $directory, $baseName, $disk);
    }

    /**
     * Delete a stored image path from disk.
     *
     * @param string|null $path
     * @param string $disk
     * @return bool true if deleted
     */
    public static function deletePath(?string $path, string $disk = 'public'): bool
    {
        if (!$path) return false;
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }
        return false;
    }
}
