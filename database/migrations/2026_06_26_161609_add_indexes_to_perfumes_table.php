<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfumes', function (Blueprint $table) {
            $table->index(['gender_target', 'is_published', 'avg_price_ngn', 'longevity_heat'], 'idx_perfume_filter');
            $table->index(['brand_id', 'is_published', 'pw_rating'], 'idx_perfume_brand');
        });

        Schema::table('prices', function (Blueprint $table) {
            $table->index(['perfume_id', 'vendor_id', 'created_at'], 'idx_prices_chart');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->index(['perfume_id', 'status', 'rating_overall', 'created_at'], 'idx_reviews_agg');
        });
    }

    public function down(): void
    {
        Schema::table('perfumes', function (Blueprint $table) {
            $table->dropIndex('idx_perfume_filter');
            $table->dropIndex('idx_perfume_brand');
        });

        Schema::table('prices', function (Blueprint $table) {
            $table->dropIndex('idx_prices_chart');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex('idx_reviews_agg');
        });
    }
};
