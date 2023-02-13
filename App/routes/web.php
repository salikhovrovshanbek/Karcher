<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\AdminController;
use \App\Http\Controllers\KarcherController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/m', [\App\Http\Controllers\MapController::class, 'index']);

//Route::view('/','welcome')->name('home');
Route::view('/first','hello')->name('first');

Route::middleware("auth")->group(function(){
    Route::get('/logout',[AuthorizationController::class,'logout'])->name('logout');
});

Route::post('admin',[AdminController::class,'login'])->name('admin');

Route::middleware("guest")->group(function(){
    Route::get('/login',[AuthorizationController::class,'showLoginForm'])->name('login');
    Route::post('/login_process',[AuthorizationController::class,'login'])->name('login_process');

    Route::get('/register',[AuthorizationController::class,'showRegisterForm'])->name('register');
    Route::post('/register_process',[AuthorizationController::class,'register'])->name('register_process');
//    Route::post('/last_registr',[AuthorizationController::class,])->name('last_reg');

    Route::get('/forgot',[AuthorizationController::class,'showForgotForm'])->name('forgot');
    Route::post('/forgot_process',[AuthorizationController::class,'forgot'])->name('forgot_process');
});

 Route::get('/', [KarcherController::class,'index'])
->name('karcher.index');

 Route::get('/karcher/create', [KarcherController::class,'create'])
->name('karcher.create');

 Route::post('/karcher', [KarcherController::class,'store'])
->name('karcher.store');

 Route::get('/karcher/{karcher}/edit', [KarcherController::class,'edit'])
->name('karcher.edit');

 Route::put('/karcher/{karcher}', [KarcherController::class,'update'])
->name('karcher.update');

 Route::delete('/karcher/{karcher}', [KarcherController::class,'destroy'])
->name('karcher.destroy');
