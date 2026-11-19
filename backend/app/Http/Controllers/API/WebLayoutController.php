<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WebLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class WebLayoutController extends Controller
{
    /**
     * Ensure table exists in case migration hasn't run yet on production.
     */
    protected function ensureTableExists()
    {
        if (!Schema::hasTable('web_layouts')) {
            try {
                Schema::create('web_layouts', function (Blueprint $table) {
                    $table->id();
                    $table->string('page', 50)->default('home')->index();
                    $table->string('key', 100)->index();
                    $table->longText('value')->nullable();
                    $table->timestamps();

                    $table->unique(['page', 'key']);
                });
            } catch (\Throwable $e) {
                // Ignore if created concurrently
            }
        }
    }

    /**
     * Return default values for a given page.
     */
    protected function getDefaults(string $page): array
    {
        if ($page === 'home') {
            return [
                'hero_slides' => [
                    [
                        'id' => 1,
                        'image' => '/images/home-page/dark-hero-bg1.webp',
                        'title' => 'Slide 1',
                        'show_splash' => true
                    ],
                    [
                        'id' => 2,
                        'image' => '/images/home-page/dark-hero-bg2.webp',
                        'title' => 'Slide 2',
                        'show_splash' => true
                    ],
                    [
                        'id' => 3,
                        'image' => '/images/home-page/dark-hero-bg3.webp',
                        'title' => 'Slide 3',
                        'show_splash' => true
                    ]
                ],
                'about_image' => '/images/home-page/about-universal-paint.webp'
            ];
        }

        if ($page === 'about') {
            return [
                'header_image' => '/images/about-us-page/hero.webp',
                'story_image' => '/images/about-us-page/paint-bucket.webp',
                'mfg_tanks_image' => '/images/about-us-page/factory-tanks.webp',
                'mfg_production_image' => '/images/about-us-page/production-line.webp',
                'mfg_lab_image' => '/images/about-us-page/lab-test.webp',
                'truck_image' => '/images/about-us-page/truck.webp',
            ];
        }

        if ($page === 'subpages' || $page === 'pages') {
            return [
                'subpage_headers' => [
                    'about' => [
                        'title' => 'About Us',
                        'route' => '/about',
                        'image' => '/images/about-us-page/hero.webp',
                        'default_image' => '/images/about-us-page/hero.webp',
                        'subtitle' => 'Our Journey & Story'
                    ],
                    'contact' => [
                        'title' => 'Contact Us',
                        'route' => '/contact',
                        'image' => '/images/contact-us-page/hero.webp',
                        'default_image' => '/images/contact-us-page/hero.webp',
                        'subtitle' => 'Get in Touch'
                    ],
                    'shop' => [
                        'title' => 'Shop / Products',
                        'route' => '/shop',
                        'image' => '/images/shop page/shop_header.webp',
                        'default_image' => '/images/shop page/shop_header.webp',
                        'subtitle' => 'Explore Our Range'
                    ],
                    'blog' => [
                        'title' => 'Blog',
                        'route' => '/blog',
                        'image' => '/images/about-us-page/hero.webp',
                        'default_image' => '/images/about-us-page/hero.webp',
                        'subtitle' => 'News & Insights'
                    ],
                    'sales_reps' => [
                        'title' => 'Sales Representatives',
                        'route' => '/sales-representatives',
                        'image' => '',
                        'default_image' => '',
                        'subtitle' => 'Island-wide Network'
                    ]
                ]
            ];
        }

        return [];
    }

    /**
     * Get layout settings for a page.
     *
     * @param string $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLayout(string $page)
    {
        $this->ensureTableExists();

        $defaults = $this->getDefaults($page);

        try {
            $records = WebLayout::where('page', $page)->get();
            $result = $defaults;

            foreach ($records as $record) {
                $result[$record->key] = $record->value;
            }

            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json($defaults);
        }
    }

    /**
     * Update layout settings for a page (Admin only).
     *
     * @param Request $request
     * @param string $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLayout(Request $request, string $page)
    {
        $this->ensureTableExists();

        $data = $request->all();

        // If 'hero_slides' is passed, validate and sanitize array structure
        if ($request->has('hero_slides')) {
            $slides = $request->input('hero_slides');
            if (is_array($slides)) {
                $cleanedSlides = [];
                foreach ($slides as $idx => $slide) {
                    $img = is_array($slide) ? ($slide['image'] ?? '') : (is_string($slide) ? $slide : '');
                    if (!empty(trim((string)$img))) {
                        $showSplash = true;
                        if (is_array($slide) && array_key_exists('show_splash', $slide)) {
                            $showSplash = filter_var($slide['show_splash'], FILTER_VALIDATE_BOOLEAN);
                        }
                        $cleanedSlides[] = [
                            'id' => is_array($slide) ? ($slide['id'] ?? ($idx + 1)) : ($idx + 1),
                            'image' => trim((string)$img),
                            'title' => is_array($slide) ? ($slide['title'] ?? ('Slide ' . ($idx + 1))) : ('Slide ' . ($idx + 1)),
                            'show_splash' => $showSplash
                        ];
                    }
                }
                $data['hero_slides'] = $cleanedSlides;
            }
        }

        // If 'about_image' is passed, sanitize string
        if ($request->has('about_image')) {
            $data['about_image'] = trim((string)$request->input('about_image'));
        }

        // If 'subpage_headers' is passed, validate and sanitize
        if ($request->has('subpage_headers')) {
            $headers = $request->input('subpage_headers');
            if (is_array($headers)) {
                $defaults = $this->getDefaults('subpages')['subpage_headers'] ?? [];
                $cleanedHeaders = [];
                foreach ($headers as $key => $headerData) {
                    $keyStr = trim((string)$key);
                    if (empty($keyStr)) continue;

                    $defaultEntry = $defaults[$keyStr] ?? [];
                    $cleanedHeaders[$keyStr] = [
                        'title' => is_array($headerData) ? ($headerData['title'] ?? ($defaultEntry['title'] ?? ucfirst($keyStr))) : ucfirst($keyStr),
                        'route' => is_array($headerData) ? ($headerData['route'] ?? ($defaultEntry['route'] ?? '')) : '',
                        'image' => is_array($headerData) ? trim((string)($headerData['image'] ?? '')) : (is_string($headerData) ? trim($headerData) : ''),
                        'default_image' => $defaultEntry['default_image'] ?? '',
                        'subtitle' => is_array($headerData) ? ($headerData['subtitle'] ?? ($defaultEntry['subtitle'] ?? '')) : ''
                    ];
                }
                $data['subpage_headers'] = $cleanedHeaders;
            }
        }

        foreach ($data as $key => $val) {
            // Ignore internal or HTTP method fields
            if (in_array($key, ['_token', '_method'])) continue;

            WebLayout::updateOrCreate(
                ['page' => $page, 'key' => $key],
                ['value' => $val]
            );
        }

        return $this->getLayout($page);
    }
}
