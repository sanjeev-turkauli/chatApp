<?php

use App\Http\Controllers\home\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\userController;
use App\Http\Controllers\chat\chatController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/",[HomeController::class,"index"])->name("homePage");
Route::get("login",[HomeController::class,"login"])->name("login");


Route::post("register",[userController::class,"create"])->name("register");
Route::post("login",[userController::class,"store"])->name("login");


Route::group(['middleware' => 'chatApp'], function () {
    Route::get("chat",[chatController::class,"index"])->name("chat");
    Route::get("get_user",[chatController::class,"show"])->name("show_user");
    Route::post("logOut",[chatController::class,"destroy"])->name("logout");
});




