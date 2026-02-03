<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

// Form routes untuk user/visitor (tanpa auth)
Route::get('/', [FormController::class, 'index'])->name('form.index');
Route::post('/form/submit', [FormController::class, 'submit'])->name('form.submit');

// Admin routes dengan prefix /admin dan middleware auth
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
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
