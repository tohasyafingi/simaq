<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SummernoteController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:webp,jpg,jpeg,png,avif,gif,svg|max:5120',
        ]);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension() ?? '');
        $originalBase = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $baseName = $originalBase ?: 'image';

        if ($ext === 'svg') {
            $safeBase = Str::slug($baseName);
            $filename = $safeBase . '-' . time() . '-' . Str::random(6) . '.svg';
            $path = $file->storeAs('summernote', $filename, 'public');
        } else {
            $path = ImageHelper::storeOptimized($file, 'summernote', $baseName, 'public');
        }

        return response()->json([
            'url' => Storage::disk('public')->url($path),
        ]);
    }
}
