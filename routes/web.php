<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UrlCheckingController;

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

Route::get('/', [HomePageController::class, 'home'])
    ->name('home');
Route::resource('urls', UrlController::class)->only(['index', 'store', 'show']);
Route::resource('urls.checks', UrlCheckingController::class)->only(['store']);
