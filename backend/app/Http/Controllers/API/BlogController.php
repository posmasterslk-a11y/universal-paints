<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        
        if (!$request->user()) {
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
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
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
            $imagePath = $request->file('image')->store('blogs', 'public');
            $validated['image'] = '/storage/' . $imagePath;
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        
        // Optionally, check if it's published unless user is admin, but keeping it simple for now.
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
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
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
                $oldPath = str_replace('/storage/', '', $blog->image);
                Storage::disk('public')->delete($oldPath);
            }
            $imagePath = $request->file('image')->store('blogs', 'public');
            $validated['image'] = '/storage/' . $imagePath;
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
            $oldPath = str_replace('/storage/', '', $blog->image);
            Storage::disk('public')->delete($oldPath);
        }
        
        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted successfully'
        ]);
    }
}
