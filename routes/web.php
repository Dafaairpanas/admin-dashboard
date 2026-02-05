<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminSubmissionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Models\Languages;


require __DIR__ . '/auth.php';

// Form routes untuk user/visitor (tanpa auth)
Route::get('/', [FormController::class, 'index'])->name('form.index');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/form/submit', [FormController::class, 'submit'])->name('form.submit');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::prefix('submissions')->group(function () {
        Route::get('/', [AdminSubmissionController::class, 'index'])->name('submissions.index');
        Route::get('/{id}/show', [AdminSubmissionController::class, 'show'])->name('submissions.show');
        Route::delete('/{id}/destroy', [AdminSubmissionController::class, 'destroy'])->name('submissions.destroy');
    });

    Route::prefix('manage')->name('manage.')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::put('/{user}/update', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
        });
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
            Route::post('/{id}/update', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/{id}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
        });
    });

    Route::prefix('master')->name('master.')->group(function () {
        Route::prefix('languages')->group(function () {
            Route::get('/', [LanguageController::class, 'index'])->name('languages.index');
            Route::get('/create', [LanguageController::class, 'create'])->name('languages.create');
            Route::post('/store', [LanguageController::class, 'store'])->name('languages.store');
            Route::get('/{id}/edit', [LanguageController::class, 'edit'])->name('languages.edit');
            Route::post('/{id}/update', [LanguageController::class, 'update'])->name('languages.update');
            Route::delete('/{id}/destroy', [LanguageController::class, 'destroy'])->name('languages.destroy');
        });

        Route::prefix('questions')->group(function () {
            Route::get('/', [QuestionController::class, 'index'])->name('questions.index');
            Route::get('/create', [QuestionController::class, 'create'])->name('questions.create');
            Route::post('/store', [QuestionController::class, 'store'])->name('questions.store');
            Route::get('/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
            Route::post('/{id}/update', [QuestionController::class, 'update'])->name('questions.update');
            Route::delete('/{id}/destroy', [QuestionController::class, 'destroy'])->name('questions.destroy');
        });
    });

});
