<?php
// web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\GetUsersController;
use App\Http\Controllers\GetItemsIDController;
use App\Http\Controllers\GetItemController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FetchContentController;
use App\Http\Controllers\DashboardController;

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

// Authenticated web routes
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::post('/content/store', [ContentController::class, 'store'])->name('content.store');
    Route::delete('/content/delete/{id}', [ContentController::class, 'destroy']);
    Route::post('/generate-qrcode', [ContentController::class, 'generateQRCode'])->name('generate.qrcode');

    Route::get('/data', [DataController::class, 'index'])->name('data.index');
    Route::post('/data', [DataController::class, 'store'])->name('data.store');
    Route::delete('/data/delete/{id}', [DataController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// The welcome route does not require authentication
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes are included from auth.php
require __DIR__.'/auth.php';
