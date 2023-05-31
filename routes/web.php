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

Route::get('', function() {return view('index');});

Route::get('/login', function() {return view('login');})->name('login');

Route::get('/cadastro', function() {return view('register');})->name('cadastro');

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => 'user'], function() {
    Route::get('update', [UserController::class, 'updateuser'])->name('user.index.update')->middleware('auth');
    Route::post('update', [UserController::class, 'update'])->name('user.update');
});

Route::group(['prefix' => 'notes'], function() {
    Route::get('', [NotesController::class, 'index'])->name('notes.index')->middleware('auth');
    Route::post('', [NotesController::class, 'create'])->name('notes.create')->middleware('auth');
    Route::get('create', [NotesController::class, 'createview'])->name('notes.index.create')->middleware('auth');
    Route::get('delete/{note}', [NotesController::class, 'delete'])->name('notes.delete')->middleware('auth');
    Route::get('update/{note}', [NotesController::class, 'updateview'])->name('notes.index.update')->middleware('auth');
    Route::post('update', [NotesController::class, 'update'])->name('notes.update')->middleware('auth');
    Route::get('favorite/{note}', [NotesController::class, 'favorite'])->name('notes.favorite')->middleware('auth');
    Route::get('unfavorite/{note}', [NotesController::class, 'unfavorite'])->name('notes.unfavorite')->middleware('auth');
});

Route::group(['prefix' => 'categories'], function() {
    Route::get('', [CategoriesController::class, 'index'])->name('categories.index')->middleware('auth');
    Route::post('', [CategoriesController::class, 'create'])->name('categories.create')->middleware('auth');
});


