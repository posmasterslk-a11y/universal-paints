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
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'category')) {
                $table->string('category', 100)->nullable()->after('title');
            }
        });

        // Set default categories for existing default blogs if they exist
        if (Schema::hasColumn('blogs', 'category')) {
            DB::table('blogs')
                ->where('slug', 'universal-paints-launches-advanced-hybrid-aquamax-waterproofing-technology')
                ->whereNull('category')
                ->update(['category' => 'Innovation & Technology']);

            DB::table('blogs')
                ->where('slug', 'color-trends-and-architectural-finishes-elevating-modern-sri-lankan-spaces')
                ->whereNull('category')
                ->update(['category' => 'Color Trends & Design']);

            DB::table('blogs')
                ->where('slug', 'expanding-nationwide-universal-paints-deepens-distribution-across-25-districts')
                ->whereNull('category')
                ->update(['category' => 'Company News & Events']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};
