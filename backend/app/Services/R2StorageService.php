<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class R2StorageService
{
    /**
     * Upload an uploaded file to Cloudflare R2 and return the full public URL.
     * Automatically compresses and resizes images if GD is available.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string
     */
    public static function upload(UploadedFile $file, string $directory = 'uploads'): string
    {
        // Attempt server-side compression and optimization
        if (self::canCompress($file)) {
            $compressed = self::compress($file);
            if ($compressed) {
                $filename = Str::random(40) . '.' . $compressed['ext'];
                $path = rtrim($directory, '/') . '/' . $filename;
                Storage::disk('r2')->put($path, $compressed['data'], [
                    'mimetype' => $compressed['mime']
                ]);
                return Storage::disk('r2')->url($path);
            }
        }

        $path = $file->store($directory, 'r2');
        return Storage::disk('r2')->url($path);
    }

    /**
     * Determine if file can be compressed with GD.
     */
    protected static function canCompress(UploadedFile $file): bool
    {
        if (!extension_loaded('gd') || !function_exists('imagecreatefromstring')) {
            return false;
        }

        $mime = strtolower($file->getMimeType() ?: '');
        return in_array($mime, ['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Compress and optimize an image stream using GD.
     */
    protected static function compress(UploadedFile $file, int $maxWidth = 1920, int $quality = 82): ?array
    {
        try {
            $contents = file_get_contents($file->getRealPath());
            if (!$contents) return null;

            $src = @imagecreatefromstring($contents);
            if (!$src) return null;

            $origWidth = imagesx($src);
            $origHeight = imagesy($src);

            if ($origWidth <= 0 || $origHeight <= 0) {
                imagedestroy($src);
                return null;
            }

            // Calculate proportionate dimensions
            $newWidth = $origWidth;
            $newHeight = $origHeight;

            if ($newWidth > $maxWidth || $newHeight > $maxWidth) {
                $ratio = min($maxWidth / $newWidth, $maxWidth / $newHeight);
                $newWidth = (int) round($newWidth * $ratio);
                $newHeight = (int) round($newHeight * $ratio);
            }

            $dst = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve alpha transparency for PNG and WebP
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
            imagefilledrectangle($dst, 0, 0, $newWidth, $newHeight, $transparent);

            // Resample smoothly
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
            imagedestroy($src);

            ob_start();
            $ext = 'webp';
            $mime = 'image/webp';

            if (function_exists('imagewebp')) {
                imagewebp($dst, null, $quality);
            } else {
                $ext = 'jpg';
                $mime = 'image/jpeg';
                imagejpeg($dst, null, $quality);
            }

            $compressedData = ob_get_clean();
            imagedestroy($dst);

            if ($compressedData && strlen($compressedData) > 0) {
                return [
                    'data' => $compressedData,
                    'ext'  => $ext,
                    'mime' => $mime,
                ];
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Image compression fallback: ' . $e->getMessage());
        }

        return null;
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

