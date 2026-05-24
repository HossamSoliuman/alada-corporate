<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
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
        $basename = Str::uuid()->toString();
        $paths = [];

        $dir = public_path($folder);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach ($sizes as $label => $width) {
            $filename = "{$basename}_{$label}.webp";
            $storagePath = "{$folder}/{$filename}";

            $image = Image::read($file->getRealPath())
                ->scaleDown(width: $width)
                ->toWebp(quality: 85);

            file_put_contents(public_path($storagePath), (string) $image);
            $paths[$label] = $storagePath;
        }

        $extension = $file->getClientOriginalExtension();
        $origName = "{$basename}_original.{$extension}";
        $origPath = "{$folder}/{$origName}";
        copy($file->getRealPath(), public_path($origPath));
        $paths['original'] = $origPath;

        return $paths;
    }

    /**
     * Delete an image file from public directory.
     */
    public function delete(string $path, string $disk = 'public'): void
    {
        $full = public_path($path);
        if (file_exists($full)) {
            @unlink($full);
        }
    }
}
