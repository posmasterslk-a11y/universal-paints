<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultCategories = [
            [
                'name' => 'Interior Paints',
                'description' => 'Premium wall and ceiling finishes formulated for durable, washable, and beautiful interiors.',
                'image' => '/images/products/interior.webp',
                'icon' => '🏢'
            ],
            [
                'name' => 'Exterior Paints',
                'description' => 'Weather-resistant, UV-blocking protective exterior coatings for homes and commercial facades.',
                'image' => '/images/products/exterior.webp',
                'icon' => '🏠'
            ],
            [
                'name' => 'Wood Finishes',
                'description' => 'Fine varnishes, wood stains, and protective sealers enhancing natural wood beauty.',
                'image' => '/images/products/wood.webp',
                'icon' => '🪵'
            ],
            [
                'name' => 'Industrial Coatings',
                'description' => 'Heavy-duty protective primers, floor coatings, and anti-corrosive industrial paints.',
                'image' => '/images/products/industrial.webp',
                'icon' => '🏭'
            ]
        ];

        foreach ($defaultCategories as $item) {
            Category::updateOrCreate(
                ['name' => $item['name']],
                [
                    'slug' => Str::slug($item['name']),
                    'description' => $item['description'],
                    'image' => $item['image'],
                    'icon' => $item['icon'],
                    'is_active' => true,
                ]
            );
        }

        // Also add any distinct categories currently assigned to products
        $productCats = Product::whereNotNull('category')->distinct()->pluck('category');
        foreach ($productCats as $catName) {
            if (!Category::where('name', $catName)->exists()) {
                Category::create([
                    'name' => $catName,
                    'slug' => Str::slug($catName),
                    'description' => "Quality coatings and products in the {$catName} category.",
                    'image' => '/images/home-page/wood.jpg',
                    'icon' => '🎨',
                    'is_active' => true,
                ]);
            }
        }
    }
}
