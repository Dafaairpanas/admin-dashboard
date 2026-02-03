<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Languages;
use App\Models\TypeQuestion;
use App\Models\Question;
use App\Models\QuestionTranslation;
use App\Models\QuestionOption;
use App\Models\QuestionOptionTranslation;
use App\Models\Survey;

class MasterDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Languages
        $id = Languages::create(['code' => 'id', 'name' => 'Indonesia', 'is_default' => 0, 'is_active' => 1]);
        $en = Languages::create(['code' => 'en', 'name' => 'English', 'is_default' => 1, 'is_active' => 1]);

        // 2. Types
        $types = [
            ['code' => 'text', 'name' => 'Short Text', 'has_options' => 0],
            ['code' => 'textarea', 'name' => 'Long Text', 'has_options' => 0],
            ['code' => 'radio', 'name' => 'Single Choice (Radio)', 'has_options' => 1],
            ['code' => 'checkbox', 'name' => 'Multiple Choice (Checkbox)', 'has_options' => 1],
            ['code' => 'checkbox_card', 'name' => 'Cards (Checkbox)', 'has_options' => 1], // For Furniture Needs
        ];

        foreach ($types as $t) {
            TypeQuestion::create($t);
        }

        // 3. Survey
        $survey = Survey::create(['is_active' => 1]);

        // 4. Questions (Mapping existing form)

        // Q1: Kebutuhan Furniture (Checkbox Cards)
        $q1 = Question::create([
            'survey_id' => $survey->id,
            'type_question_id' => TypeQuestion::where('code', 'checkbox_card')->first()->id,
            'key' => 'kebutuhan_furniture',
            'urutan' => 1,
            'is_required' => 1,
            'is_active' => 1
        ]);
        $this->addTranslation($q1, 'id', 'Kebutuhan Furniture');
        $this->addTranslation($q1, 'en', 'Furniture Needs');

        $op1 = $this->addOption($q1, 1);
        $this->addOptionTranslation($op1, 'id', 'Indoor Furniture');
        $this->addOptionTranslation($op1, 'en', 'Indoor Furniture');

        $op2 = $this->addOption($q1, 2);
        $this->addOptionTranslation($op2, 'id', 'Outdoor Furniture');
        $this->addOptionTranslation($op2, 'en', 'Outdoor Furniture');


        // Q2: Detail Kebutuhan (Textarea)
        $q2 = Question::create([
            'survey_id' => $survey->id,
            'type_question_id' => TypeQuestion::where('code', 'textarea')->first()->id,
            'key' => 'detail_kebutuhan',
            'urutan' => 2,
            'is_required' => 0,
            'is_active' => 1
        ]);
        $this->addTranslation($q2, 'id', 'Detail Kebutuhan Furniture');
        $this->addTranslation($q2, 'en', 'Furniture Details');


        // Q3: Estimasi Budget (Radio) -> Using Checkbox logic in form-custom.js max=1
        // Form uses data-checkbox with max=1, effectively Radio. Let's use Radio type in DB for logic.
        $q3 = Question::create([
            'survey_id' => $survey->id,
            'type_question_id' => TypeQuestion::where('code', 'radio')->first()->id,
            'key' => 'estimasi_budget',
            'urutan' => 3,
            'is_required' => 1,
            'is_active' => 1
        ]);
        $this->addTranslation($q3, 'id', 'Estimasi Budget');
        $this->addTranslation($q3, 'en', 'Estimated Budget');

        $opts3 = [
            ['id' => '< Rp10 juta', 'en' => '< IDR 10 million'],
            ['id' => 'Rp10 - 50 juta', 'en' => 'IDR 10 - 50 million'],
            ['id' => 'Rp50 - 200 juta', 'en' => 'IDR 50 - 200 million'],
            ['id' => '> Rp200 juta', 'en' => '> IDR 200 million'],
        ];
        foreach ($opts3 as $idx => $txt) {
            $o = $this->addOption($q3, $idx + 1);
            $this->addOptionTranslation($o, 'id', $txt['id']);
            $this->addOptionTranslation($o, 'en', $txt['en']);
        }


        // Q4: Estimasi Waktu (Radio)
        $q4 = Question::create([
            'survey_id' => $survey->id,
            'type_question_id' => TypeQuestion::where('code', 'radio')->first()->id,
            'key' => 'estimasi_waktu',
            'urutan' => 4,
            'is_required' => 0,
            'is_active' => 1
        ]);
        $this->addTranslation($q4, 'id', 'Estimasi Waktu proyek / Pembelian');
        $this->addTranslation($q4, 'en', 'Project / Purchase Timeline');

        $opts4 = [
            ['id' => 'Segera (1 - 3 bulan ke depan)', 'en' => 'Immediately (1 - 3 months)'],
            ['id' => 'Jangka Menengah (3 - 6 bulan ke depan)', 'en' => 'Medium Term (3 - 6 months)'],
            ['id' => 'Hanya melihat-lihat / Mencari Referensi', 'en' => 'Just browsing / Looking for references'],
        ];
        foreach ($opts4 as $idx => $txt) {
            $o = $this->addOption($q4, $idx + 1);
            $this->addOptionTranslation($o, 'id', $txt['id']);
            $this->addOptionTranslation($o, 'en', $txt['en']);
        }


        // Q5: Estimasi Jumlah (Radio)
        $q5 = Question::create([
            'survey_id' => $survey->id,
            'type_question_id' => TypeQuestion::where('code', 'radio')->first()->id,
            'key' => 'estimasi_jumlah',
            'urutan' => 5,
            'is_required' => 0,
            'is_active' => 1
        ]);
        $this->addTranslation($q5, 'id', 'Estimasi Jumlah / Item');
        $this->addTranslation($q5, 'en', 'Estimated Quantity / Items');

        $opts5 = [
            ['id' => '1 Set', 'en' => '1 Set'],
            ['id' => '< 5 Pcs', 'en' => '< 5 Pcs'],
            ['id' => '5 - 20 Pcs', 'en' => '5 - 20 Pcs'],
            ['id' => '> 20 Pcs', 'en' => '> 20 Pcs'],
        ];
        foreach ($opts5 as $idx => $txt) {
            $o = $this->addOption($q5, $idx + 1);
            $this->addOptionTranslation($o, 'id', $txt['id']);
            $this->addOptionTranslation($o, 'en', $txt['en']);
        }


        // Q6: Preferensi Brand (Checkbox Max 2)
        // Note: DB doesn't handle "Max selections" natively in schema, will rely on JS or Description.
        $q6 = Question::create([
            'survey_id' => $survey->id,
            'type_question_id' => TypeQuestion::where('code', 'checkbox')->first()->id,
            'key' => 'preferensi_brand',
            'urutan' => 6,
            'is_required' => 0,
            'is_active' => 1
        ]);
        $this->addTranslation($q6, 'id', 'Apa yang paling Anda cari dari sebuah brand furniture? (Pilih maks. 2)');
        $this->addTranslation($q6, 'en', 'What do you look for most in a furniture brand? (Choose max. 2)');

        $opts6 = [
            ['id' => 'Desain yang unik & Estetik', 'en' => 'Unique & Aesthetic Design'],
            ['id' => 'Daya tahan material (Durability)', 'en' => 'Material Durability'],
            ['id' => 'Harga yang kompetitif', 'en' => 'Competitive Pricing'],
            ['id' => 'Kemudahan kustomisasi (Custom-made)', 'en' => 'Easy Customization (Custom-made)'],
        ];
        foreach ($opts6 as $idx => $txt) {
            $o = $this->addOption($q6, $idx + 1);
            $this->addOptionTranslation($o, 'id', $txt['id']);
            $this->addOptionTranslation($o, 'en', $txt['en']);
        }
    }

    private function addTranslation($question, $lang, $text)
    {
        QuestionTranslation::create([
            'question_id' => $question->id,
            'language_code' => $lang,
            'question_text' => $text
        ]);
    }

    private function addOption($question, $order)
    {
        return QuestionOption::create([
            'question_id' => $question->id,
            'urutan' => $order
        ]);
    }

    private function addOptionTranslation($option, $lang, $text)
    {
        QuestionOptionTranslation::create([
            'question_option_id' => $option->id,
            'language_code' => $lang,
            'option_text' => $text
        ]);
    }
}
