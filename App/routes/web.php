<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
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
    return view('welcome');
});


Route::middleware("auth")->group(function(){
    Route::get('/logout',[AuthorizationController::class,'logout'])->name('logout');
});

Route::middleware("guest")->group(function(){
    Route::get('/login',[AuthorizationController::class,'showLoginForm'])->name('login');
    Route::post('/login_process',[AuthorizationController::class,'login'])->name('login_process');

    Route::get('/register',[AuthorizationController::class,'showRegisterForm'])->name('register');
    Route::post('/register_process',[AuthorizationController::class,'register'])->name('register_process');

    Route::get('/forgot',[AuthorizationController::class,'showForgotForm'])->name('forgot');
    Route::post('/forgot_process',[AuthorizationController::class,'forgot'])->name('forgot_process');
});





/*
auth.login   ->showLoginForm
return redirect(route("home"));   ->logout
return redirect(route("login"))->withErrors(["email"=>"User not found Or your data is incorrect"]);   ->login
auth.register   ->showRegisterForm
auth.forgetPass     ->showForgotForm
return redirect(route("login")); ->forgot
return redirect(route("home")); ->register
*/
