<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register'])->name('api.auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');
});

Route::group(['prefix' => 'user'], function() {
    Route::get('', [UserController::class, 'index'])->name('api.user.index');
});

Route::group(['prefix' => 'notes'], function() {
    Route::get('', [NotesController::class, 'index'])->name('api.notes.index');
    Route::get('{note}', [NotesController::class, 'show'])->name('api.notes.show');
    Route::put('{note}', [NotesController::class, 'update'])->name('api.notes.update');
    Route::delete('{note}', [NotesController::class, 'delete'])->name('api.notes.delete');
    Route::post('', [NotesController::class, 'create'])->name('api.notes.create');
});