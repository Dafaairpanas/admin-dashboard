<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Models\Languages;


require __DIR__ . '/auth.php';

// Form routes untuk user/visitor (tanpa auth)
Route::get('/', [FormController::class, 'index'])->name('form.index');
Route::post('/form/submit', [FormController::class, 'submit'])->name('form.submit');
// Route::post('/switch-language', function(Request $request) {
//     $lang = $request->input('lang', 'en');

//     // Validasi bahasa yang tersedia
//     $validLangs = Languages::where('is_active', 1)
//         ->pluck('code')
//         ->toArray();

//     if (!in_array($lang, $validLangs)) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Invalid language'
//         ], 400);
//     }

//     // Simpan ke session
//     session(['selected_language' => $lang]);

//     // Return dengan cookie
//     return response()->json([
//         'success' => true,
//         'lang' => $lang
//     ])->cookie('selected_language', $lang, 60 * 24 * 90); // 90 hari
// })->name('switch.language');

// Admin routes dengan prefix /admin dan middleware auth
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('roles', \App\Http\Controllers\RoleController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('languages', \App\Http\Controllers\LanguageController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('questions', \App\Http\Controllers\QuestionController::class);
    Route::resource('submissions', \App\Http\Controllers\AdminSubmissionController::class)->only(['index', 'destroy']);

    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])
        ->where('first', '^(?!build|\.).*')
        ->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])
        ->where('first', '^(?!build|\.).*')
        ->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])
        ->where('any', '^(?!build|\.).*')
        ->name('any');
});
