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
        Schema::create('master_visitor_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_category_id')->nullable()->constrained('master_visitor_categories')->onDelete('set null');
            $table->string('language_code');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_visitor_category_translations');
    }
};
