<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews')->default(0);
            $table->decimal('price_min', 10, 2)->nullable();
            $table->decimal('price_max', 10, 2)->nullable();
            $table->json('features')->nullable();
            $table->json('pack_sizes')->nullable();
            $table->json('colors')->nullable();
            $table->json('gallery')->nullable();
            $table->string('main_image')->nullable();
            $table->boolean('is_best_seller')->default(false);
            $table->boolean('is_in_stock')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
