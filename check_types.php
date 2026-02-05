<?php
use App\Models\TypeQuestion;
use App\Models\Question;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$types = TypeQuestion::all();
echo "Type Questions:\n";
foreach ($types as $t) {
    echo "- ID: {$t->id}, Name: {$t->name}, Code: {$t->code}\n";
}

$selectType = $types->where('code', 'select')->first();
if ($selectType) {
    $count = Question::where('type_question_id', $selectType->id)->count();
    echo "\nQuestions using 'select': {$count}\n";
}
