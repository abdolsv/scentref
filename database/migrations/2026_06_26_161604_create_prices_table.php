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
        Schema::create("prices", function (Blueprint $table) {
            $table->id();
            $table->foreignId("perfume_id")->constrained()->cascadeOnDelete();
            $table->foreignId("vendor_id")->constrained();
            $table->decimal("price_ngn", 12, 2)->notNull();
            $table->boolean("is_verified")->default(false);
            $table->foreignId("verified_by")->nullable()->constrained("users");
            $table->string("source_url", 500)->nullable();
            $table->boolean("is_current")->default(true);
            $table->timestamps();
            $table->index(["perfume_id","vendor_id","is_current"]);
            $table->index(["created_at"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
