<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiLoginController;
use App\Http\Controllers\ApiAdminController;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[ApiLoginController::class,'logout']);
    Route::get('/results/:name',[ApiLoginController::class,'detailedresults']);


    Route::get('/results',[ApiAdminController::class,'getresults']);
    Route::Post('/results',[ApiAdminController::class,'postresults']);
    Route::Post('/results/delete',[ApiAdminController::class,'deleteconcour']);
    Route::Post('/results/upload',[ApiAdminController::class,'uploadconcourimage']);
});

Route::post('/login',[ApiLoginController::class,'login']);
Route::post('/register',[ApiLoginController::class,'register']);

Route::get('/users',[ApiAdminController::class,'getUsers']);
Route::get('/payments',[ApiAdminController::class,'getPayments']);