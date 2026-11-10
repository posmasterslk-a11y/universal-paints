<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class R2StorageService
{
    /**
     * Upload an uploaded file to Cloudflare R2 and return the full public URL.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string
     */
    public static function upload(UploadedFile $file, string $directory = 'uploads'): string
    {
        $path = $file->store($directory, 'r2');
        return Storage::disk('r2')->url($path);
    }

    /**
     * Upload raw content to Cloudflare R2 and return the full public URL.
     *
     * @param string $contents
     * @param string $path
     * @return string
     */
    public static function put(string $path, string $contents): string
    {
        Storage::disk('r2')->put($path, $contents);
        return Storage::disk('r2')->url($path);
    }

    /**
     * Delete an image from R2 (or legacy public storage if applicable).
     *
     * @param string|null $url
     * @return bool
     */
    public static function delete(?string $url): bool
    {
        if (!$url) {
            return false;
        }

        $r2Url = config('filesystems.disks.r2.url');

        // Check if file is stored in Cloudflare R2
        if ($r2Url && Str::startsWith($url, $r2Url)) {
            $relativePath = ltrim(Str::after($url, $r2Url), '/');
            return Storage::disk('r2')->delete($relativePath);
        }

        // Also check if URL matches any r2.dev or cloudflarestorage endpoint
        if (Str::contains($url, '.r2.dev/') || Str::contains($url, '.r2.cloudflarestorage.com/')) {
            $parsed = parse_url($url, PHP_URL_PATH);
            $relativePath = ltrim($parsed, '/');
            return Storage::disk('r2')->delete($relativePath);
        }

        // If it was legacy local public storage
        if (Str::startsWith($url, '/storage/')) {
            $relativePath = Str::after($url, '/storage/');
            return Storage::disk('public')->delete($relativePath);
        }

        return false;
    }
}

