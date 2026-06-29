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
        Schema::create("reviews", function (Blueprint $table) {
            $table->id();
            $table->foreignId("perfume_id")->constrained()->cascadeOnDelete();
            $table->foreignId("user_id")->nullable()->constrained()->nullOnDelete();
            $table->string("reviewer_name");
            $table->string("reviewer_email")->nullable();
            $table->string("reviewer_city")->nullable();
            $table->enum("reviewer_climate", [
                "hot_outdoor","ac_office","cool_evening","harmattan"
            ])->default("hot_outdoor");
            $table->unsignedTinyInteger("rating_overall");
            $table->unsignedTinyInteger("rating_longevity")->nullable();
            $table->unsignedTinyInteger("rating_sillage")->nullable();
            $table->unsignedTinyInteger("rating_value")->nullable();
            $table->string("purchase_source")->nullable();
            $table->decimal("purchase_price_ngn", 12, 2)->nullable();
            $table->string("review_title")->nullable();
            $table->text("review_body");
            $table->boolean("verified_purchase")->default(false);
            $table->unsignedInteger("helpful_votes")->default(0);
            $table->enum("status", ["pending","approved","rejected","spam"])->default("pending");
            $table->string("verification_token")->nullable();
            $table->timestamp("email_verified_at")->nullable();
            $table->timestamp("approved_at")->nullable();
            $table->foreignId("approved_by")->nullable()->constrained("users");
            $table->timestamps();
            $table->index(["perfume_id","status"]);
            $table->index(["status","created_at"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
