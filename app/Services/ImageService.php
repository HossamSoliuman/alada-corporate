<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    /**
     * Upload an image, generate multiple sizes + WebP, return paths array.
     */
    public function upload(
        UploadedFile $file,
        string $disk = 'public',
        string $folder = 'uploads',
        array $sizes = ['thumb' => 300, 'medium' => 800, 'large' => 1600]
    ): array {
        $basename  = Str::uuid()->toString();
        $extension = $file->getClientOriginalExtension();
        $paths     = [];

        foreach ($sizes as $label => $width) {
            $filename    = "{$basename}_{$label}.webp";
            $storagePath = "{$folder}/{$filename}";

            $image = Image::read($file->getRealPath())
                ->scaleDown(width: $width)
                ->toWebp(quality: 85);

            Storage::disk($disk)->put($storagePath, (string) $image);
            $paths[$label] = $storagePath;
        }

        // Also store original
        $origName  = "{$basename}_original.{$extension}";
        $origPath  = "{$folder}/{$origName}";
        Storage::disk($disk)->put($origPath, file_get_contents($file->getRealPath()));
        $paths['original'] = $origPath;

        return $paths;
    }

    /**
     * Delete all size variants of an image.
     */
    public function delete(string $path, string $disk = 'public'): void
    {
        Storage::disk($disk)->delete($path);
    }
}
