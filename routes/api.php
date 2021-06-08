<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\santriController;
use App\Http\Controllers\walsanController;
use App\Http\Controllers\pembimbingController;
use App\Http\Controllers\jurnalController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/santri', santriController::class);
Route::post('/santri/upload', [santriController::class, 'uploadExcel']);
Route::resource('/walsan', walsanController::class);
Route::resource('/pembimbing', pembimbingController::class);
Route::resource('/jurnal', jurnalController::class);