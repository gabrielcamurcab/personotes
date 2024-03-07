<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/cadastro', function () {
    return view('register');
})->name('cadastro');

Route::get('/forgot-password', function () {
    return view('forgotpassword');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.forgot');

Route::get('/reset-password/{token}', function (string $token) {
    return view('resetpassword', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

Route::get('/email/verify', function () {
    return view('verifyemail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'VerifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verification-notification', [AuthController::class, 'resendEmailVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('update', [UserController::class, 'updateuser'])->name('user.index.update')->middleware(['auth', 'verified']);
    Route::post('update', [UserController::class, 'update'])->name('user.update');
});

Route::group(['prefix' => 'notes'], function () {
    Route::get('', [NotesController::class, 'index'])->name('notes.index')->middleware(['auth', 'verified']);
    Route::get('categorie/{categorieid}', [NotesController::class, 'indexByCategorie'])->name('notes.indexbycategorie')->middleware(['auth', 'verified']);
    Route::post('', [NotesController::class, 'create'])->name('notes.create')->middleware(['auth', 'verified']);
    Route::get('create', [NotesController::class, 'createview'])->name('notes.index.create')->middleware(['auth', 'verified']);
    Route::get('delete/{note}', [NotesController::class, 'delete'])->name('notes.delete')->middleware(['auth', 'verified']);
    Route::get('update/{note}', [NotesController::class, 'updateview'])->name('notes.index.update')->middleware(['auth', 'verified']);
    Route::post('update', [NotesController::class, 'update'])->name('notes.update')->middleware(['auth', 'verified']);
    Route::get('favorite/{note}', [NotesController::class, 'favorite'])->name('notes.favorite')->middleware(['auth', 'verified']);
    Route::get('unfavorite/{note}', [NotesController::class, 'unfavorite'])->name('notes.unfavorite')->middleware(['auth', 'verified']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('', [CategoriesController::class, 'index'])->name('categories.index')->middleware(['auth', 'verified']);
    Route::post('', [CategoriesController::class, 'create'])->name('categories.create')->middleware(['auth', 'verified']);
    Route::get('delete/{categorie}', [CategoriesController::class, 'delete'])->name('categories.delete')->middleware(['auth', 'verified']);
    Route::get('update/{categorie}', [CategoriesController::class, 'updateview'])->name('categories.index.update')->middleware(['auth', 'verified']);
    Route::post('update', [CategoriesController::class, 'update'])->name('categories.update')->middleware(['auth', 'verified']);
});
