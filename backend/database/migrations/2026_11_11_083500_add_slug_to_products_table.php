<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'slug')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name')->index();
            });

            try {
                foreach (Product::all() as $prod) {
                    $slug = Str::slug($prod->name);
                    if (Product::where('slug', $slug)->where('id', '!=', $prod->id)->exists()) {
                        $slug .= '-' . $prod->id;
                    }
                    $prod->updateQuietly(['slug' => $slug]);
                }
            } catch (\Throwable $e) {
                // Ignore if in early migration
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('products', 'slug')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};

