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
        Schema::create('question_option_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_option_id')->nullable()->constrained('question_options')->onDelete('set null');
            $table->string('language_code');
            $table->text('option_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_option_translations');
    }
};
