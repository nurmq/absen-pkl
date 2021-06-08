<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\santriController;
use App\Http\Controllers\walsanController;
use App\Http\Controllers\pembimbingController;
use App\Http\Controllers\jurnalController;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('login',[UserController::class, 'loginError']);
Route::post('login',[UserController::class, 'login'])->name('login');
Route::post('register',[UserController::class, 'register']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::resource('/santri', santriController::class);    
    Route::post('/santri/upload', [santriController::class, 'uploadExcel']); //upload santri by excel

    Route::resource('/walsan', walsanController::class);

    Route::resource('/pembimbing', pembimbingController::class);
    Route::get('/pembimbing/list-santri/{id}', [pembimbingController::class, 'listSiswa']); //list santri bedasarkan pembimbingnya

    Route::resource('/jurnal', jurnalController::class);
    Route::get('/jurnal/list-jurnal-by-pembimbing/{id}', [jurnalController::class, 'listJurnalByPembimbing']); //list jurnal bedasarkan pembimbingnya
    Route::get('/jurnal/list-jurnal-by-walsan/{id}', [jurnalController::class, 'listJurnalByWalsan']); //list jurnal bedasarkan walsannya
});