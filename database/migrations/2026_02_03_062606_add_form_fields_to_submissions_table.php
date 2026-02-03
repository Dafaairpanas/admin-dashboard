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
            // Ensure these columns don't already exist or are nullable
            if (!Schema::hasColumn('submissions', 'kategori_pengunjung')) {
                $table->string('kategori_pengunjung')->nullable()->after('email');
            }
            if (!Schema::hasColumn('submissions', 'nama_perusahaan')) {
                $table->string('nama_perusahaan')->nullable()->after('kategori_pengunjung');
            }
            if (!Schema::hasColumn('submissions', 'posisi_jabatan')) {
                $table->string('posisi_jabatan')->nullable()->after('nama_perusahaan');
            }
            if (!Schema::hasColumn('submissions', 'jenis_bisnis')) {
                $table->json('jenis_bisnis')->nullable()->after('posisi_jabatan');
            }
            if (!Schema::hasColumn('submissions', 'jenis_bisnis_lainnya')) {
                $table->string('jenis_bisnis_lainnya')->nullable()->after('jenis_bisnis');
            }
            if (!Schema::hasColumn('submissions', 'kebutuhan_furniture')) {
                $table->json('kebutuhan_furniture')->nullable()->after('jenis_bisnis_lainnya');
            }
            if (!Schema::hasColumn('submissions', 'detail_kebutuhan')) {
                $table->text('detail_kebutuhan')->nullable()->after('kebutuhan_furniture');
            }
            if (!Schema::hasColumn('submissions', 'estimasi_budget')) {
                $table->string('estimasi_budget')->nullable()->after('detail_kebutuhan');
            }
            if (!Schema::hasColumn('submissions', 'estimasi_waktu')) {
                $table->string('estimasi_waktu')->nullable()->after('estimasi_budget');
            }
            if (!Schema::hasColumn('submissions', 'estimasi_jumlah')) {
                $table->json('estimasi_jumlah')->nullable()->after('estimasi_waktu');
            }
            if (!Schema::hasColumn('submissions', 'preferensi_brand')) {
                $table->json('preferensi_brand')->nullable()->after('estimasi_jumlah');
            }
            if (!Schema::hasColumn('submissions', 'consent')) {
                $table->boolean('consent')->default(0)->after('preferensi_brand');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn([
                'kategori_pengunjung',
                'nama_perusahaan',
                'posisi_jabatan',
                'jenis_bisnis',
                'jenis_bisnis_lainnya',
                'kebutuhan_furniture',
                'detail_kebutuhan',
                'estimasi_budget',
                'estimasi_waktu',
                'estimasi_jumlah',
                'preferensi_brand',
                'consent'
            ]);
        });
    }
};
