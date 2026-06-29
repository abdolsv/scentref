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
        Schema::create("perfume_alternatives", function (Blueprint $table) {
            $table->id();
            $table->foreignId("source_perfume_id")->constrained("perfumes")->cascadeOnDelete();
            $table->foreignId("alternative_perfume_id")->constrained("perfumes")->cascadeOnDelete();
            $table->enum("relationship_type", [
                "budget","similar_smell","premium","dupe","same_house"
            ]);
            $table->enum("price_tier", [
                "under_3000","3k_to_7k","7k_to_15k","15k_to_30k","above_30k"
            ])->nullable();
            $table->text("editorial_note")->nullable();
            $table->unsignedTinyInteger("sort_order")->default(0);
            $table->unique(["source_perfume_id","alternative_perfume_id","relationship_type"]);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfume_alternatives');
    }
};
