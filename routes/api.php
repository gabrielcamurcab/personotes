<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotesController;
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

Route::group(['prefix' => 'notes'], function (){
    Route::get('index', [NotesController::class, 'index'])->name('api.notes.index');
    Route::get('{note}', [NotesController::class, 'show'])->name('api.notes.show');
    Route::post('create', [NotesController::class, 'create'])->name('api.notes.create');
});
