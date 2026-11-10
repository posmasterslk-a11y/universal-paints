<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Services\R2StorageService;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $query = Category::query()->withCount('products');

        if ($request->boolean('active_only')) {
            $query->where('is_active', true);
        }

        if ($request->boolean('home_only')) {
            $query->where('show_on_home', true);
        }

        $categories = $query->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($categories);
    }

    /**
     * Store a newly created category with image upload.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $slug = Str::slug($validated['name']);
        if (Category::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = R2StorageService::upload($request->file('image'), 'categories');
        }

        $isActive = true;
        if ($request->has('is_active')) {
            $isActive = filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN);
        }

        $showOnHome = false;
        if ($request->has('show_on_home')) {
            $showOnHome = filter_var($request->input('show_on_home'), FILTER_VALIDATE_BOOLEAN);
        }

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'icon' => $validated['icon'] ?? '🎨',
            'image' => $imagePath,
            'is_active' => $isActive,
            'show_on_home' => $showOnHome,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category->loadCount('products'),
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        $category = Category::withCount('products')->where('id', $id)->orWhere('slug', $id)->firstOrFail();
        return response()->json($category);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($category->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $slug . '-' . time();
            }
            $category->slug = $slug;
        }

        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? null;
        if (isset($validated['icon'])) {
            $category->icon = $validated['icon'];
        }

        if ($request->has('is_active')) {
            $category->is_active = filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN);
        }

        if ($request->has('show_on_home')) {
            $category->show_on_home = filter_var($request->input('show_on_home'), FILTER_VALIDATE_BOOLEAN);
        }

        if ($request->hasFile('image')) {
            // Delete old uploaded image if it was on R2 or storage
            if ($category->image) {
                R2StorageService::delete($category->image);
            }
            $category->image = R2StorageService::upload($request->file('image'), 'categories');
        }

        $category->save();

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category->loadCount('products'),
        ]);
    }

    /**
     * Remove the specified category.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            R2StorageService::delete($category->image);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
