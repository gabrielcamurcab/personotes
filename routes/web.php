<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', [NotesController::class, 'index'])->name('index')->middleware('auth');

Route::get('/login', function() {
    return view('login');
})->name('login');

Route::get('/cadastro', function() {
    return view('register');
})->name('cadastro');

Route::get('/restrito', function() {
    return view('restrito');
})->name('restrito')->middleware('auth');

Route::get('/notes/create', function() {
    return view('notescreate');
})->name('notes.index.create')->middleware('auth');

Route::get('notes/update/{note}', [NotesController::class, 'updateview'])->name('notes.index.update')->middleware('auth');
Route::get('user/update', [UserController::class, 'updateuser'])->name('user.index.update')->middleware('auth');
Route::post('user/update', [UserController::class, 'update'])->name('user.update');

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('notes', [NotesController::class, 'index'])->name('notes.index')->middleware('auth');
Route::post('notes', [NotesController::class, 'create'])->name('notes.create')->middleware('auth');
Route::get('notes/delete/{note}', [NotesController::class, 'delete'])->name('notes.delete')->middleware('auth');
Route::post('notes/update', [NotesController::class, 'update'])->name('notes.update')->middleware('auth');


