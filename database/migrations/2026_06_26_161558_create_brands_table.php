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
        Schema::create("brands", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug")->unique();
            $table->text("description")->nullable();
            $table->string("origin_country")->nullable();
            $table->enum("tier", [
                "luxury","designer","niche","accessible_designer","budget","arabian"
            ]);
            $table->string("website_url")->nullable();
            $table->string("logo_path")->nullable();
            $table->text("nigeria_availability_note")->nullable();
            $table->text("editor_note")->nullable();
            $table->boolean("is_featured")->default(false);
            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
