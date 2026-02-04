<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\QuestionTranslation;
use App\Models\QuestionOptionTranslation;
use App\Models\TypeQuestion;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get survey ID (assuming there's a survey with id 1)
        $surveyId = Survey::first()->id ?? 1;

        // Get type questions
        $typeText = TypeQuestion::where('code', 'text')->first();
        $typeNumber = TypeQuestion::where('code', 'number')->first();
        $typeTextarea = TypeQuestion::where('code', 'textarea')->first();
        $typeRadio = TypeQuestion::where('code', 'radio')->first();
        $typeCheckbox = TypeQuestion::where('code', 'checkbox')->first();
        $typeCheckboxCard = TypeQuestion::where('code', 'checkbox_card')->first();
        $typeDropdown = TypeQuestion::where('code', 'dropdown')->first();

        DB::beginTransaction();
        try {
            // Question 1: Kebutuhan Furniture (Checkbox Card)
            $q1 = Question::create([
                'survey_id' => $surveyId,
                'type_question_id' => $typeCheckboxCard->id,
                'urutan' => 1,
                'is_required' => true,
                'is_active' => true,
                'key' => 'kebutuhan_furniture'
            ]);

            QuestionTranslation::create([
                'question_id' => $q1->id,
                'language_code' => 'id',
                'question_text' => 'Kebutuhan Furniture'
            ]);

            QuestionTranslation::create([
                'question_id' => $q1->id,
                'language_code' => 'en',
                'question_text' => 'Furniture Needs'
            ]);

            // Options for Q1
            $opt1_1 = QuestionOption::create(['question_id' => $q1->id, 'urutan' => 1]);
            QuestionOptionTranslation::create(['question_option_id' => $opt1_1->id, 'language_code' => 'id', 'option_text' => 'Indoor Furniture']);
            QuestionOptionTranslation::create(['question_option_id' => $opt1_1->id, 'language_code' => 'en', 'option_text' => 'Indoor Furniture']);

            $opt1_2 = QuestionOption::create(['question_id' => $q1->id, 'urutan' => 2]);
            QuestionOptionTranslation::create(['question_option_id' => $opt1_2->id, 'language_code' => 'id', 'option_text' => 'Outdoor Furniture']);
            QuestionOptionTranslation::create(['question_option_id' => $opt1_2->id, 'language_code' => 'en', 'option_text' => 'Outdoor Furniture']);

            // Question 2: Detail Kebutuhan Furniture (Textarea)
            $q2 = Question::create([
                'survey_id' => $surveyId,
                'type_question_id' => $typeTextarea->id,
                'urutan' => 2,
                'is_required' => false,
                'is_active' => true,
                'key' => 'detail_kebutuhan'
            ]);

            QuestionTranslation::create([
                'question_id' => $q2->id,
                'language_code' => 'id',
                'question_text' => 'Detail Kebutuhan Furniture'
            ]);

            QuestionTranslation::create([
                'question_id' => $q2->id,
                'language_code' => 'en',
                'question_text' => 'Furniture Details'
            ]);

            // Question 3: Estimasi Budget (Radio)
            $q3 = Question::create([
                'survey_id' => $surveyId,
                'type_question_id' => $typeRadio->id,
                'urutan' => 3,
                'is_required' => false,
                'is_active' => true,
                'key' => 'estimasi_budget'
            ]);

            QuestionTranslation::create([
                'question_id' => $q3->id,
                'language_code' => 'id',
                'question_text' => 'Estimasi Budget'
            ]);

            QuestionTranslation::create([
                'question_id' => $q3->id,
                'language_code' => 'en',
                'question_text' => 'Estimated Budget'
            ]);

            // Options for Q3
            $opt3_1 = QuestionOption::create(['question_id' => $q3->id, 'urutan' => 1]);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_1->id, 'language_code' => 'id', 'option_text' => '< Rp10 juta']);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_1->id, 'language_code' => 'en', 'option_text' => '< IDR 10 million']);

            $opt3_2 = QuestionOption::create(['question_id' => $q3->id, 'urutan' => 2]);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_2->id, 'language_code' => 'id', 'option_text' => 'Rp10 - 50 juta']);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_2->id, 'language_code' => 'en', 'option_text' => 'IDR 10 - 50 million']);

            $opt3_3 = QuestionOption::create(['question_id' => $q3->id, 'urutan' => 3]);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_3->id, 'language_code' => 'id', 'option_text' => 'Rp50 - 200 juta']);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_3->id, 'language_code' => 'en', 'option_text' => 'IDR 50 - 200 million']);

            $opt3_4 = QuestionOption::create(['question_id' => $q3->id, 'urutan' => 4]);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_4->id, 'language_code' => 'id', 'option_text' => '> Rp200 juta']);
            QuestionOptionTranslation::create(['question_option_id' => $opt3_4->id, 'language_code' => 'en', 'option_text' => '> IDR 200 million']);

            // Question 4: Estimasi Waktu (Radio)
            $q4 = Question::create([
                'survey_id' => $surveyId,
                'type_question_id' => $typeRadio->id,
                'urutan' => 4,
                'is_required' => false,
                'is_active' => true,
                'key' => 'estimasi_waktu'
            ]);

            QuestionTranslation::create([
                'question_id' => $q4->id,
                'language_code' => 'id',
                'question_text' => 'Estimasi Waktu Proyek / Pembelian'
            ]);

            QuestionTranslation::create([
                'question_id' => $q4->id,
                'language_code' => 'en',
                'question_text' => 'Project / Purchase Timeline'
            ]);

            // Options for Q4
            $opt4_1 = QuestionOption::create(['question_id' => $q4->id, 'urutan' => 1]);
            QuestionOptionTranslation::create(['question_option_id' => $opt4_1->id, 'language_code' => 'id', 'option_text' => 'Segera (1 - 3 bulan ke depan)']);
            QuestionOptionTranslation::create(['question_option_id' => $opt4_1->id, 'language_code' => 'en', 'option_text' => 'Immediately (1 - 3 months)']);

            $opt4_2 = QuestionOption::create(['question_id' => $q4->id, 'urutan' => 2]);
            QuestionOptionTranslation::create(['question_option_id' => $opt4_2->id, 'language_code' => 'id', 'option_text' => 'Jangka Menengah (3 - 6 bulan ke depan)']);
            QuestionOptionTranslation::create(['question_option_id' => $opt4_2->id, 'language_code' => 'en', 'option_text' => 'Medium Term (3 - 6 months)']);

            $opt4_3 = QuestionOption::create(['question_id' => $q4->id, 'urutan' => 3]);
            QuestionOptionTranslation::create(['question_option_id' => $opt4_3->id, 'language_code' => 'id', 'option_text' => 'Hanya melihat-lihat / Mencari Referensi']);
            QuestionOptionTranslation::create(['question_option_id' => $opt4_3->id, 'language_code' => 'en', 'option_text' => 'Just browsing / Looking for references']);

            // Question 5: Estimasi Jumlah (Checkbox)
            $q5 = Question::create([
                'survey_id' => $surveyId,
                'type_question_id' => $typeCheckbox->id,
                'urutan' => 5,
                'is_required' => false,
                'is_active' => true,
                'key' => 'estimasi_jumlah'
            ]);

            QuestionTranslation::create([
                'question_id' => $q5->id,
                'language_code' => 'id',
                'question_text' => 'Estimasi Jumlah / Item'
            ]);

            QuestionTranslation::create([
                'question_id' => $q5->id,
                'language_code' => 'en',
                'question_text' => 'Estimated Quantity / Items'
            ]);

            // Options for Q5
            $opt5_1 = QuestionOption::create(['question_id' => $q5->id, 'urutan' => 1]);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_1->id, 'language_code' => 'id', 'option_text' => '1 Set']);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_1->id, 'language_code' => 'en', 'option_text' => '1 Set']);

            $opt5_2 = QuestionOption::create(['question_id' => $q5->id, 'urutan' => 2]);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_2->id, 'language_code' => 'id', 'option_text' => '< 5 Pcs']);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_2->id, 'language_code' => 'en', 'option_text' => '< 5 Pcs']);

            $opt5_3 = QuestionOption::create(['question_id' => $q5->id, 'urutan' => 3]);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_3->id, 'language_code' => 'id', 'option_text' => '5 - 20 Pcs']);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_3->id, 'language_code' => 'en', 'option_text' => '5 - 20 Pcs']);

            $opt5_4 = QuestionOption::create(['question_id' => $q5->id, 'urutan' => 4]);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_4->id, 'language_code' => 'id', 'option_text' => '> 20 Pcs']);
            QuestionOptionTranslation::create(['question_option_id' => $opt5_4->id, 'language_code' => 'en', 'option_text' => '> 20 Pcs']);

            // Question 6: Preferensi Brand (Checkbox - max 2)
            $q6 = Question::create([
                'survey_id' => $surveyId,
                'type_question_id' => $typeCheckbox->id,
                'urutan' => 6,
                'is_required' => false,
                'is_active' => true,
                'key' => 'preferensi_brand'
            ]);

            QuestionTranslation::create([
                'question_id' => $q6->id,
                'language_code' => 'id',
                'question_text' => 'Apa yang paling Anda cari dari sebuah brand furniture?'
            ]);

            QuestionTranslation::create([
                'question_id' => $q6->id,
                'language_code' => 'en',
                'question_text' => 'What do you look for most in a furniture brand?'
            ]);

            // Options for Q6
            $opt6_1 = QuestionOption::create(['question_id' => $q6->id, 'urutan' => 1]);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_1->id, 'language_code' => 'id', 'option_text' => 'Desain yang unik & Estetik']);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_1->id, 'language_code' => 'en', 'option_text' => 'Unique & Aesthetic Design']);

            $opt6_2 = QuestionOption::create(['question_id' => $q6->id, 'urutan' => 2]);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_2->id, 'language_code' => 'id', 'option_text' => 'Daya tahan material (Durability)']);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_2->id, 'language_code' => 'en', 'option_text' => 'Material Durability']);

            $opt6_3 = QuestionOption::create(['question_id' => $q6->id, 'urutan' => 3]);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_3->id, 'language_code' => 'id', 'option_text' => 'Harga yang kompetitif']);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_3->id, 'language_code' => 'en', 'option_text' => 'Competitive Pricing']);

            $opt6_4 = QuestionOption::create(['question_id' => $q6->id, 'urutan' => 4]);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_4->id, 'language_code' => 'id', 'option_text' => 'Kemudahan kustomisasi (Custom-made)']);
            QuestionOptionTranslation::create(['question_option_id' => $opt6_4->id, 'language_code' => 'en', 'option_text' => 'Easy Customization (Custom-made)']);

            DB::commit();
            $this->command->info('✅ Questions seeded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('❌ Error seeding questions: ' . $e->getMessage());
        }
    }
}
