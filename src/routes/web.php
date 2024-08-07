<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);


Route::get('/', [AtteController::class, 'index'])->middleware(['auth', 'verified']);


Route::group(['middleware' => 'auth'], function() {
    Route::post('/startwork', [AtteController::class, 'startWork'])->name('startwork');
    Route::post('/endwork', [AtteController::class, 'endWork'])->name('endwork');
    Route::post('/startrest', [AtteController::class, 'startRest'])->name('startrest');
    Route::post('/endrest', [AtteController::class, 'endRest'])->name('endrest');
});


Route::get('/attendance', [AtteController::class, 'getWorks']);
Route::get('/attendance/{num}', [AtteController::class, 'getWorks']);


Route::get('/userlist', [AtteController::class, 'getUsers']);
Route::get('/userpage', [AtteController::class, 'userWorks'])->name('user.page');

