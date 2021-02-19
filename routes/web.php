<?php

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

// Route::get('/panel', function () {
//     return view('/');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\ArticleController::class, 'index']);
    Route::post('/articles', [App\Http\Controllers\ArticleController::class, 'store']);
    Route::get('/articles/create', [App\Http\Controllers\ArticleController::class, 'create']);
    Route::get('/articles/{article}', [App\Http\Controllers\ArticleController::class, 'show']);
});

