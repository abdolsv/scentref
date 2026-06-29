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
        Schema::create("price_alerts", function (Blueprint $table) {
            $table->id();
            $table->foreignId("perfume_id")->constrained()->cascadeOnDelete();
            $table->string("email");
            $table->decimal("target_price_ngn", 12, 2);
            $table->string("unsubscribe_token")->unique();
            $table->timestamp("last_notified_at")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->index(["perfume_id","is_active"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_alerts');
    }
};
