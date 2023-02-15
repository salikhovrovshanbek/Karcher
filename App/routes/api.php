<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KarcherController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::delete('/karcher/delete/{id}',[KarcherController::class,'destroy']);


Route::controller(KarcherController::class)->prefix('/karcher')->group(function (){
    Route::get('/list','index');
    Route::post('/create','store');
    Route::post('/edit','update');
    Route::delete('/delete','destroy');
});

Route::controller(AuthorizationController::class)->group(function () {
    Route::post('/signup', 'register');
    Route::post('/login', 'login');
    Route::post('/send-sms', 'sendSms');
    Route::post('/auth-phone', 'loginWithSms');
});

Route::controller(UserController::class)->prefix('/user-profile')->group(function (){
    Route::get('/','index');
    Route::post('/edit','edit');
});

//Route::controller(\App\Http\Controllers\Api\UserProfileController::class)->prefix('/user-profile')->middleware('auth:sanctum')->group(function (){
//    Route::post('/edit', 'edit');
//    Route::get('/', 'index');
//
//});
