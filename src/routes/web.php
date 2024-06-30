<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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
    return view('stamp');
})->middleware(['auth', 'verified']);


Route::group(['middleware' => 'auth'], function() {
    Route::post('/startwork', [AtteController::class, 'startWork'])->name('startwork');
    Route::post('/endwork', [AtteController::class, 'endWork'])->name('endwork');
    Route::post('/startrest', [AtteController::class, 'startRest'])->name('startrest');
    Route::post('/endrest', [AtteController::class, 'endRest'])->name('endrest');
});

Route::get('/attendance', [AtteController::class, 'getWorks']);
Route::get('/attendance/{num}', [AtteController::class, 'getWorks']);

