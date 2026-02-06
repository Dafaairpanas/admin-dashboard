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
Route::get('/verify-email/{token}', [FormController::class, 'verifyEmail'])->name('form.verify');
Route::post('/form/save-step1', [FormController::class, 'saveStep1'])->name('form.saveStep1');
Route::post('/form/submit', [FormController::class, 'submit'])->name('form.submit');

// Permission denied route
Route::get('/permission-denied', function () {
    return view('errors.permission-denied');
})->name('permission.denied');

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

Route::group(['middleware' => ['auth', 'role.uac']], function () {
    // Dashboard - code: DASHBOARDS
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('DASHBOARDS.read');

    // Submissions - code: SUBMISSIONS
    Route::prefix('submissions')->group(function () {
        Route::get('/', [AdminSubmissionController::class, 'index'])->name('SUBMISSIONS.read');
        Route::get('/{id}/show', [AdminSubmissionController::class, 'show'])->name('SUBMISSIONS.update');
        Route::delete('/{id}/destroy', [AdminSubmissionController::class, 'destroy'])->name('SUBMISSIONS.delete');
    });

    // Management - Users & Roles
    Route::prefix('manage')->group(function () {
        // Users - code: USERS
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('USERS.read');
            Route::post('/store', [UserController::class, 'store'])->name('USERS.create');
            Route::put('/{user}/update', [UserController::class, 'update'])->name('USERS.update');
            Route::delete('/{user}/destroy', [UserController::class, 'destroy'])->name('USERS.delete');
        });
        // Roles - code: ROLES
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('ROLES.read');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('ROLES.update');
            Route::post('/store', [RoleController::class, 'store'])->name('ROLES.store');
            Route::post('/{id}/update', [RoleController::class, 'update'])->name('ROLES.update.submit');
            Route::delete('/{id}/destroy', [RoleController::class, 'destroy'])->name('ROLES.delete');
        });
    });

    // Master - Languages & Questions
    Route::prefix('master')->group(function () {
        // Languages - code: LANGUAGES
        Route::prefix('languages')->group(function () {
            Route::get('/', [LanguageController::class, 'index'])->name('LANGUAGES.read');
            Route::get('/create', [LanguageController::class, 'create'])->name('LANGUAGES.create.form');
            Route::post('/store', [LanguageController::class, 'store'])->name('LANGUAGES.create.save');
            Route::get('/{id}/edit', [LanguageController::class, 'edit'])->name('LANGUAGES.update.form');
            Route::post('/{id}/update', [LanguageController::class, 'update'])->name('LANGUAGES.update.save');
            Route::delete('/{id}/destroy', [LanguageController::class, 'destroy'])->name('LANGUAGES.delete');
        });

        // Questions - code: QUESTIONS
        Route::prefix('questions')->group(function () {
            Route::get('/', [QuestionController::class, 'index'])->name('QUESTIONS.read');
            Route::get('/create', [QuestionController::class, 'create'])->name('QUESTIONS.create.form');
            Route::post('/store', [QuestionController::class, 'store'])->name('QUESTIONS.create.save');
            Route::get('/{id}/edit', [QuestionController::class, 'edit'])->name('QUESTIONS.update.form');
            Route::post('/{id}/update', [QuestionController::class, 'update'])->name('QUESTIONS.update.save');
            Route::delete('/{id}/destroy', [QuestionController::class, 'destroy'])->name('QUESTIONS.delete');
        });
    });

    // Dynamic Routes for Templates using RoutingController
    // This allows accessing views directly, e.g. /pages/starter
    Route::group(['prefix' => '/'], function () {
        Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
        Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
        Route::get('{any}', [RoutingController::class, 'root'])->name('root');
    });

});
