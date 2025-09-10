<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpenIDController;

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
Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('index/{area?}/{school_type?}', [HomeController::class,'index'])->name('index_select');
Route::get('teacher/{area?}/{school_type?}', [HomeController::class,'teacher'])->name('teacher_select');
Route::get('student/{area?}/{school_type?}', [HomeController::class,'student'])->name('student_select');
Route::get('refresh', [HomeController::class,'refresh'])->name('refresh');
//openid登入
Route::get('sso', [OpenIDController::class,'sso'])->name('sso');
Route::get('auth/callback', [OpenIDController::class,'callback'])->name('callback');
Route::get('logout', [OpenIDController::class,'logout'])->name('logout');