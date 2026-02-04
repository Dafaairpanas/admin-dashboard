<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TypeQuestion;

class TypeQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'code' => 'text',
                'name' => 'Short Answer (Input)',
                'has_options' => false,
            ],
            [
                'code' => 'number',
                'name' => 'Number Input',
                'has_options' => false,
            ],
            [
                'code' => 'textarea',
                'name' => 'Paragraph (Text Area)',
                'has_options' => false,
            ],
            [
                'code' => 'radio',
                'name' => 'Single Choice (Radio)',
                'has_options' => true,
            ],
            [
                'code' => 'checkbox',
                'name' => 'Multiple Choice (Checklist)',
                'has_options' => true,
            ],
            [
                'code' => 'checkbox_card',
                'name' => 'Checkbox Card',
                'has_options' => true,
            ],
            [
                'code' => 'dropdown',
                'name' => 'Dropdown (Select)',
                'has_options' => true,
            ],
        ];

        foreach ($types as $type) {
            TypeQuestion::updateOrCreate(
                ['code' => $type['code']],
                ['name' => $type['name'], 'has_options' => $type['has_options']]
            );
        }
    }
}
