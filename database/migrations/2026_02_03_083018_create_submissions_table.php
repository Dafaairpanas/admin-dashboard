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
        Schema::create('master_visitor_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->nullable()->constrained('surveys')->onDelete('set null');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->foreignId('visitor_category_id')->nullable()->constrained('master_visitor_categories')->onDelete('set null');
            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('business_type')->nullable();
            $table->datetime('wa_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_visitor_categories');
        Schema::dropIfExists('submissions');
    }
};
