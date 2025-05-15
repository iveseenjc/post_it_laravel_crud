<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarPickController;
use App\Http\Controllers\HomePageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function() {
    Route::get('/posts', [HomePageController::class, 'index'])->name('index.home');
    Route::post('/posts', [HomePageController::class, 'store'])->name('store.home');
    Route::get('/posts/{id}/edit', [HomePageController::class, 'edit'])->name('edit.home');
    Route::put('/posts/{id}', [HomePageController::class, 'update'])->name('update.home');
    Route::delete('/posts/{id}', [HomePageController::class, 'destroy'])->name('destroy.home');

    
    Route::get('/pickAvatar', [AvatarPickController::class, 'showAvatarPick'])->name('show.avatar');
    Route::post('/pickAvatar', [AvatarPickController::class, 'store'])->name('store.avatar');
});