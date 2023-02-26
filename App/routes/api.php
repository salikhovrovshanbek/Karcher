<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KarcherController;
use App\Http\Controllers\MapController;


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

Route::get('/',function (){
    return ["Welcome to Karcher Project"];
});

Route::controller(KarcherController::class)->middleware(['auth:sanctum'])->prefix('/karcher')->group(function (){
    Route::get('/list','index');
    Route::post('/create','store');
    Route::post('/edit','update');
    Route::delete('/delete','destroy');
});

Route::controller(AuthorizationController::class)->middleware('guest')->group(function () {
    Route::post('/login', 'login')->name('login');
//    Route::post('login', [ 'as' => 'login', 'uses' => 'AuthorizationController@login']);
    Route::post('/signup', 'register')->name('register');
    Route::post('/logout','logout')->name('logout');
//    Route::get('/forgot','forgot')->name('forgot');---------|\
//    Route::post('/send-sms', 'sendSms');                    | |-->the same
//    Route::post('/auth-phone', 'loginWithSms');-------------|/
});


Route::controller(UserController::class)->prefix('/user')->middleware(['auth:sanctum'])->group(function (){
    Route::post('/dashboard','index');
    Route::get('/list','show');
    Route::post('/create','create');
    Route::post('/edit','edit');
    Route::delete('/delete','destroy');
    Route::post('/change-password','updatepassword');
});

//Route::post('/edit',[UserController::class,'edit'])->middleware(['auth:sanctum','admin']);
// ->middleware(['auth:sanctum','admin'])

//Route::group(['middleware'=>['auth','admin']],function (){
//    Route::post('/s',[MapController::class,'something']);
//});
