<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\R2StorageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = Product::query();
            if ($request->has('category')) {
                $query->where('category', $request->category);
            }
            return response()->json($query->get());
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Database error: ' . $e->getMessage(),
                'error' => $e->getMessage(),
                'diag' => [
                    'base_path' => base_path(),
                    'env_file_exists' => file_exists(base_path('.env')),
                    'env_readable' => is_readable(base_path('.env')),
                    'config_cached' => app()->configurationIsCached(),
                    'config_cached_file' => file_exists(app()->getCachedConfigPath()),
                    'env_db' => env('DB_DATABASE'),
                    'env_user' => env('DB_USERNAME'),
                ]
            ], 500);
        }
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
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_min' => 'nullable|numeric',
            'price_max' => 'nullable|numeric',
            'features' => 'nullable|array',
            'pack_sizes' => 'nullable|array',
            'colors' => 'nullable|array',
            'gallery' => 'nullable|array',
            'main_image' => 'nullable',
            'is_best_seller' => 'boolean',
            'is_in_stock' => 'boolean',
        ]);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = R2StorageService::upload($request->file('main_image'), 'products');
        }

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string|int  $identifier
     * @return \Illuminate\Http\Response
     */
    public function show($identifier)
    {
        $product = null;

        // 1. If numeric, look up by primary key ID
        if (is_numeric($identifier)) {
            $product = Product::find($identifier);
        }

        // 2. If not found or if string, check if slug column exists
        if (!$product && \Illuminate\Support\Facades\Schema::hasColumn('products', 'slug')) {
            $product = Product::where('slug', $identifier)->first();
        }

        // 3. Match by slugified name from all products
        if (!$product) {
            $product = Product::all()->first(function ($p) use ($identifier) {
                return \Illuminate\Support\Str::slug($p->name) === $identifier;
            });
        }

        // 4. Fallback: match by approximate name
        if (!$product) {
            $nameGuess = str_replace(['-', '_'], ' ', $identifier);
            $product = Product::where('name', 'LIKE', "%{$nameGuess}%")->first();
        }

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
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
        $product = Product::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('main_image')) {
            if ($product->main_image) {
                R2StorageService::delete($product->main_image);
            }
            $data['main_image'] = R2StorageService::upload($request->file('main_image'), 'products');
        }

        $product->update($data);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->main_image) {
            R2StorageService::delete($product->main_image);
        }

        $product->delete();
        return response()->json(null, 204);
    }
}

