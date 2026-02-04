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
Route::post('/switch-language', function (\Illuminate\Http\Request $request) {
    $lang = $request->input('lang', 'en');

    // Validasi bahasa yang tersedia
    $validLangs = Languages::where('is_active', 1)
        ->pluck('code')
        ->toArray();

    if (!in_array($lang, $validLangs)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid language'
        ], 400);
    }

    // Simpan ke session
    session(['selected_language' => $lang]);

    // Return dengan cookie (optional check if API or web)
    return response()->json([
        'success' => true,
        'lang' => $lang
    ]);
})->name('switch.language');

// Admin routes dengan prefix /admin dan middleware auth
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    // Routes accessible only by superadmin
    Route::group([
        'middleware' => function ($request, $next) {
            if (!auth()->user()->hasRole('superadmin')) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        }
    ], function () {
        Route::resource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('roles', \App\Http\Controllers\RoleController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    Route::resource('languages', \App\Http\Controllers\LanguageController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('questions', \App\Http\Controllers\QuestionController::class);
    Route::resource('submissions', \App\Http\Controllers\AdminSubmissionController::class)->only(['index', 'show', 'destroy']);

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
