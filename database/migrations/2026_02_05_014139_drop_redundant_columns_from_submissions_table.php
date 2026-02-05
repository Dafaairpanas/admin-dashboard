<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn([
                'kebutuhan_furniture',
                'detail_kebutuhan',
                'estimasi_budget',
                'estimasi_waktu',
                'estimasi_jumlah',
                'preferensi_brand',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('kebutuhan_furniture')->nullable();
            $table->text('detail_kebutuhan')->nullable();
            $table->string('estimasi_budget')->nullable();
            $table->string('estimasi_waktu')->nullable();
            $table->string('estimasi_jumlah')->nullable();
            $table->string('preferensi_brand')->nullable();
        });
    }
};
