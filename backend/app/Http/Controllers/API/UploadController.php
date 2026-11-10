<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\R2StorageService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Upload an image to Cloudflare R2 and return the URL.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg,gif|max:10240',
            'folder' => 'nullable|string|max:50',
        ]);

        $folder = $request->input('folder', 'uploads');
        $folder = preg_replace('/[^a-zA-Z0-9_\-\/]/', '', $folder) ?: 'uploads';

        $url = R2StorageService::upload($request->file('image'), $folder);

        return response()->json([
            'message' => 'Image uploaded successfully to Cloudflare R2',
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

        $deleted = R2StorageService::delete($request->input('url'));

        return response()->json([
            'message' => $deleted ? 'File deleted successfully' : 'File could not be deleted or not found',
            'deleted' => $deleted,
        ]);
    }
}

