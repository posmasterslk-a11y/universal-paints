<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\R2StorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    /**
     * Upload an image to Cloudflare R2 (with local storage fallback) and return the public URL.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|file|max:20480', // Allow up to 20MB
            'folder' => 'nullable|string|max:50',
        ]);

        $file = $request->file('image');
        if (!$file || !$file->isValid()) {
            return response()->json([
                'message' => 'Uploaded file is invalid or corrupted.'
            ], 422);
        }

        // Validate image extension safely without relying solely on finfo mime
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'webp', 'svg', 'gif', 'bmp'];
        $ext = strtolower($file->getClientOriginalExtension());
        $guessed = strtolower($file->guessExtension() ?: '');

        if (!in_array($ext, $allowedExtensions) && !in_array($guessed, $allowedExtensions)) {
            return response()->json([
                'message' => 'The file must be an image (JPG, PNG, WebP, SVG, GIF).'
            ], 422);
        }

        $folder = $request->input('folder', 'uploads');
        $folder = preg_replace('/[^a-zA-Z0-9_\-\/]/', '', $folder) ?: 'uploads';

        $url = null;

        // 1. Primary: Cloudflare R2 upload
        try {
            $url = R2StorageService::upload($file, $folder);
        } catch (\Throwable $e) {
            Log::warning('R2 direct upload failed, attempting fallback: ' . $e->getMessage());
        }

        // 2. Secondary fallback: Local public storage disk
        if (!$url) {
            try {
                $path = $file->store($folder, 'public');
                $url = '/storage/' . $path;
            } catch (\Throwable $e2) {
                Log::error('Upload fallback to public disk also failed: ' . $e2->getMessage());
                return response()->json([
                    'message' => 'Upload failed: ' . $e2->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'message' => 'Image uploaded successfully',
            'url' => $url,
        ]);
    }

    /**
     * Delete an image from Cloudflare R2.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'url' => 'required|string',
        ]);

        $url = $request->input('url');
        $deleted = false;

        try {
            $deleted = R2StorageService::delete($url);
        } catch (\Throwable $e) {
            Log::warning('Delete from R2 failed: ' . $e->getMessage());
        }

        return response()->json([
            'message' => $deleted ? 'File deleted successfully' : 'File could not be deleted or not found',
            'deleted' => $deleted,
        ]);
    }
}
