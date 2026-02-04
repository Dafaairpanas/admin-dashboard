<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MasterVisitorCategory;
use Illuminate\Database\Seeder;

class VisitorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterVisitorCategory::create([
            'name' => 'Perseorangan',
        ]);
        MasterVisitorCategory::create([
            'name' => 'Instansi/Perusahaan (B2B)',
        ]);
    }
}
