<?php

use App\Http\Controllers\SpecialPageController;
use App\Http\Controllers\ClientsController;
use App\Http\Middleware\SpecialPageChecker;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ClientsController::class, 'create'])
    ->name('client-create');
Route::post('/', [ClientsController::class, 'store']);

Route::middleware(SpecialPageChecker::class)->group(function() {
    Route::get('/special-page/{specialPage:hash}/play', [SpecialPageController::class, 'play'])
        ->where(['specialPage' => '.+'])
        ->name('special-page-play');

    Route::get('/special-page/{specialPage:hash}/history', [SpecialPageController::class, 'history'])
        ->where(['specialPage' => '.+'])
        ->name('special-page-history');

    Route::get('/special-page/{specialPage:hash}/create-new', [SpecialPageController::class, 'store'])
        ->where(['specialPage' => '.+'])
        ->name('special-page-create-new');

    Route::get('/special-page/{specialPage:hash}/destroy', [SpecialPageController::class, 'destroy'])
        ->where(['specialPage' => '.+'])
        ->name('special-page-destroy');

    Route::get('/special-page/{specialPage:hash}', [SpecialPageController::class, 'show'])
        ->where(['specialPage' => '.+'])
        ->name('special-page');
});
