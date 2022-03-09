<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'index']);
Route::get('/kategori', [UserController::class, 'index']);
Route::get('/signup', [UserController::class, 'signUp']);
Route::post('/signup', [UserController::class, 'signUpStore']);
Route::get('/signup/emailverification', [UserController::class, 'signUpVerification']);
Route::get('/kategori/{page}', [UserController::class, 'kategori']);
Route::get('/produk/{id}', [UserController::class, 'produkDetail']);

//AUTH
Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [AuthController::class, 'authLogin']);
Route::post('/logout', [AuthController::class, 'authLogout']);

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/admin', AdminUserController::class);
});
