<?php
use App\Models\TypeQuestion;
use App\Models\Question;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting fix...\n";

// 1. Get IDs
$selectType = TypeQuestion::where('code', 'select')->first();
$dropdownType = TypeQuestion::where('code', 'dropdown')->first();

if (!$selectType) {
    echo "Type 'select' not found. Nothing to do.\n";
    exit;
}

if (!$dropdownType) {
    echo "Type 'dropdown' not found! Cannot migrate.\n";
    exit;
}

// 2. Migrate Questions
$count = Question::where('type_question_id', $selectType->id)->update([
    'type_question_id' => $dropdownType->id
]);
echo "Migrated {$count} questions from 'select' to 'dropdown'.\n";

// 3. Delete 'select' type
$selectType->delete();
echo "Deleted type 'select'.\n";

echo "Done.\n";
