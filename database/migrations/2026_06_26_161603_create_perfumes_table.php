<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("perfumes", function (Blueprint $table) {
            $table->id();
            // Identity
            $table->string("name");
            $table->string("slug")->unique();
            $table->foreignId("brand_id")->constrained("brands");
            $table->foreignId("scent_family_id")->nullable()->constrained("scent_families");
            $table->year("year_released")->nullable();
            $table->string("perfumer")->nullable();
            $table->enum("gender_target", ["men","women","unisex"]);
            $table->enum("concentration", ["parfum","edp","edt","edc","body_spray","oil"]);
            $table->string("collection_line")->nullable();
            $table->text("official_description")->nullable();
            // Olfactory
            $table->text("opening_character")->nullable();
            $table->text("drydown_character")->nullable();
            $table->text("longevity_notes")->nullable();
            // Nigerian Performance
            $table->unsignedTinyInteger("longevity_heat")->nullable();
            $table->unsignedTinyInteger("longevity_ac")->nullable();
            $table->decimal("longevity_hours_avg", 4, 1)->nullable();
            $table->unsignedTinyInteger("sillage_rating")->nullable();
            $table->enum("projection", [
                "skin_scent","soft","moderate","strong","beast_mode"
            ])->nullable();
            $table->json("best_season_nigeria")->nullable();
            $table->json("best_occasion")->nullable();
            // Nigerian Market
            $table->enum("availability", [
                "available","import_only","not_available"
            ])->default("available");
            $table->decimal("avg_price_ngn", 12, 2)->nullable();
            $table->json("physical_store_cities")->nullable();
            $table->date("last_price_updated")->nullable();
            $table->enum("import_difficulty", [
                "easy","moderate","hard","import_only"
            ])->nullable();
            // Media
            $table->string("bottle_image_path")->nullable();
            $table->string("box_image_path")->nullable();
            $table->string("official_website_url")->nullable();
            $table->string("fragrantica_url")->nullable();
            // Editorial
            $table->text("review_summary")->nullable();
            $table->unsignedTinyInteger("pw_rating")->nullable();
            $table->text("who_should_buy")->nullable();
            $table->text("who_should_avoid")->nullable();
            $table->enum("our_verdict", [
                "must_buy","highly_recommended","recommended","worth_trying","skip"
            ])->nullable();
            $table->text("authenticity_tips")->nullable();
            // SEO
            $table->string("meta_title")->nullable();
            $table->string("meta_description")->nullable();
            // Status
            $table->boolean("is_complete")->default(false);
            $table->boolean("is_published")->default(false);
            $table->timestamp("published_at")->nullable();
            $table->timestamps();
            $table->softDeletes();
            // Indexes
            $table->index(["brand_id", "is_published"]);
            $table->index(["scent_family_id", "is_published"]);
            $table->index(["gender_target", "is_published"]);
            $table->index(["avg_price_ngn"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfumes');
    }
};
