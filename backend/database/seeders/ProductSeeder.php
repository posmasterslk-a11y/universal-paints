<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Universal Super Silk',
                'subtitle' => 'Premium Interior Emulsion',
                'category' => 'Interior Paints',
                'description' => 'A luxurious interior emulsion that gives your walls a rich, smooth, and washable finish.',
                'price_min' => 2500,
                'price_max' => 18500,
                'rating' => '4.8',
                'reviews' => 124,
                'features' => ['Washable', 'Stain Resistant', 'Low VOC', 'Anti-Fungal'],
                'colors' => ['#FFFFFF', '#FDE68A', '#FEE2E2', '#E0E7FF'],
                'pack_sizes' => [
                    ['size' => '1L', 'price' => 2500],
                    ['size' => '4L', 'price' => 8500],
                    ['size' => '10L', 'price' => 18500]
                ],
                'main_image' => '/images/home-page/interior.jpg',
                'is_best_seller' => true,
                'is_in_stock' => true,
            ],
            [
                'name' => 'Universal Weather Protect',
                'subtitle' => 'Advanced Exterior Emulsion',
                'category' => 'Exterior Paints',
                'description' => 'Ultimate protection for your exterior walls against harsh weather conditions, algae, and fungi.',
                'price_min' => 3200,
                'price_max' => 22000,
                'rating' => '4.9',
                'reviews' => 89,
                'features' => ['Weather Proof', 'Anti-Algal', 'UV Resistant', '7 Year Warranty'],
                'colors' => ['#F1F5F9', '#FEF3C7', '#FFEDD5'],
                'pack_sizes' => [
                    ['size' => '1L', 'price' => 3200],
                    ['size' => '4L', 'price' => 11500],
                    ['size' => '10L', 'price' => 22000]
                ],
                'main_image' => '/images/home-page/exterior.jpg',
                'is_best_seller' => true,
                'is_in_stock' => true,
            ],
            [
                'name' => 'Universal Wood Finish',
                'subtitle' => 'Premium Enamel for Wood & Metal',
                'category' => 'Wood Finishes',
                'description' => 'High gloss enamel that provides a tough, durable finish for all wood and metal surfaces.',
                'price_min' => 1500,
                'price_max' => 5500,
                'rating' => '4.7',
                'reviews' => 56,
                'features' => ['High Gloss', 'Rust Proof', 'Quick Dry', 'Durable'],
                'colors' => ['#1E293B', '#B45309', '#047857'],
                'pack_sizes' => [
                    ['size' => '500ml', 'price' => 1500],
                    ['size' => '1L', 'price' => 2800],
                    ['size' => '4L', 'price' => 5500]
                ],
                'main_image' => '/images/home-page/wood.jpg',
                'is_best_seller' => false,
                'is_in_stock' => true,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
