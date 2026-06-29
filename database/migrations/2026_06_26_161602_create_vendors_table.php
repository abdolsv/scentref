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
        Schema::create("vendors", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug")->unique();
            $table->enum("type", ["marketplace","dedicated","physical","social"])
                  ->default("marketplace");
            $table->string("website_url")->nullable();
            $table->string("affiliate_param")->nullable();
            $table->string("affiliate_value")->nullable();
            $table->text("notes")->nullable();
            $table->boolean("is_active")->default(true);
            $table->boolean("is_verified")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
