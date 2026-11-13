<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\R2StorageService;

// Universal Paints Blog Controller API
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // If request is from admin panel (has token), show all. Otherwise, only published.
        $query = Blog::query();
        
        $user = $request->user() ?? auth('sanctum')->user();
        if (!$user) {
            $query->where('status', 'published');
        }

        $blogs = $query->orderBy('created_at', 'desc')->get();
        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable'
        ]);

        $slug = Str::slug($validated['title']);
        
        // Ensure slug is unique
        if (Blog::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }
        
        $validated['slug'] = $slug;

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            try {
                $validated['image'] = R2StorageService::upload($request->file('image'), 'blogs');
            } catch (\Throwable $e) {
                try {
                    $path = $request->file('image')->store('blogs', 'public');
                    $validated['image'] = '/storage/' . $path;
                } catch (\Throwable $e2) {
                    \Illuminate\Support\Facades\Log::error('Blog image upload fallback failed: ' . $e2->getMessage());
                }
            }
        } elseif ($request->has('image')) {
            $validated['image'] = $request->input('image') ?: null;
        }

        // Auto-check and add category column if missing in database
        if (!\Illuminate\Support\Facades\Schema::hasColumn('blogs', 'category')) {
            try {
                \Illuminate\Support\Facades\Schema::table('blogs', function ($table) {
                    $table->string('category', 100)->nullable()->after('title');
                });
            } catch (\Throwable $e) {
                unset($validated['category']);
            }
        }

        $blog = Blog::create($validated);

        return response()->json([
            'message' => 'Blog created successfully',
            'blog' => $blog
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string|int  $identifier
     * @return \Illuminate\Http\Response
     */
    public function show($identifier)
    {
        if (is_numeric($identifier)) {
            $blog = Blog::find($identifier);
        } else {
            $blog = Blog::where('slug', $identifier)->first();
        }
        
        if (!$blog) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        return response()->json($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable'
        ]);

        // If title changed, update slug
        if ($blog->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            if (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $slug . '-' . time();
            }
            $validated['slug'] = $slug;
        }

        if ($validated['status'] === 'published' && $blog->status !== 'published') {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image) {
                R2StorageService::delete($blog->image);
            }
            try {
                $validated['image'] = R2StorageService::upload($request->file('image'), 'blogs');
            } catch (\Throwable $e) {
                try {
                    $path = $request->file('image')->store('blogs', 'public');
                    $validated['image'] = '/storage/' . $path;
                } catch (\Throwable $e2) {
                    \Illuminate\Support\Facades\Log::error('Blog image update fallback failed: ' . $e2->getMessage());
                }
            }
        } elseif ($request->has('image')) {
            $newImage = $request->input('image') ?: null;
            if ($blog->image && $newImage !== $blog->image && empty($newImage)) {
                R2StorageService::delete($blog->image);
            }
            $validated['image'] = $newImage;
        }

        // Auto-check and add category column if missing in database
        if (!\Illuminate\Support\Facades\Schema::hasColumn('blogs', 'category')) {
            try {
                \Illuminate\Support\Facades\Schema::table('blogs', function ($table) {
                    $table->string('category', 100)->nullable()->after('title');
                });
            } catch (\Throwable $e) {
                unset($validated['category']);
            }
        }

        $blog->update($validated);

        return response()->json([
            'message' => 'Blog updated successfully',
            'blog' => $blog
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        
        if ($blog->image) {
            R2StorageService::delete($blog->image);
        }
        
        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted successfully'
        ]);
    }
}
