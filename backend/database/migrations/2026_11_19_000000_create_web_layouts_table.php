<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('web_layouts')) {
            Schema::create('web_layouts', function (Blueprint $table) {
                $table->id();
                $table->string('page', 50)->default('home')->index();
                $table->string('key', 100)->index();
                $table->longText('value')->nullable();
                $table->timestamps();

                $table->unique(['page', 'key']);
            });

            // Seed initial hero slides for home page
            $defaultSlides = [
                [
                    'id' => 1,
                    'image' => '/images/home-page/dark-hero-bg1.webp',
                    'title' => 'Slide 1'
                ],
                [
                    'id' => 2,
                    'image' => '/images/home-page/dark-hero-bg2.webp',
                    'title' => 'Slide 2'
                ],
                [
                    'id' => 3,
                    'image' => '/images/home-page/dark-hero-bg3.webp',
                    'title' => 'Slide 3'
                ]
            ];

            DB::table('web_layouts')->insert([
                'page' => 'home',
                'key' => 'hero_slides',
                'value' => json_encode($defaultSlides),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_layouts');
    }
};
