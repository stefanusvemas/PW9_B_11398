<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamBukuController;
use App\Http\Controllers\KembaliController;

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
//login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionRegister'])->name('actionRegister');
Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');

//logout
Route::get('logout', [LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('buku', BukuController::class)->middleware('auth');
Route::resource('pinjam_buku', PinjamBukuController::class)->middleware('auth');
Route::resource('kembali', KembaliController::class)->middleware('auth');
