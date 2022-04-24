<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SocialController;
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
Route::get('/signup/detail', [UserController::class, 'signUpDetail']);
Route::post('/signup', [UserController::class, 'signUpStore']);
Route::get('/signup/emailverification/{id}', [UserController::class, 'signUpVerification']);
Route::post('/signup/emailverification/', [UserController::class, 'signUpVerificationStore']);
Route::get('/kategori/{page}', [UserController::class, 'kategori']);
Route::get('/produk', [UserController::class, 'produk']);
Route::get('/produk/{id}', [UserController::class, 'produkDetail']);

//Product Transaction
Route::get('/produk/addToCart/{id}', [UserController::class, 'addToCart']);
Route::get('/keranjang', [UserController::class, 'keranjang']);
Route::get('/catatan', [UserController::class, 'catatanPembelian']);
Route::post('/keranjang/deleteitem', [UserController::class, 'keranjangItemHapus']);
Route::get('/checkout', [UserController::class, 'checkout']);
Route::post('/checkout/konfirmasiPembelian', [UserController::class, 'checkoutKonfirmasi']);

Route::get('/api/provinsiGet', [UserController::class, 'provinsiGet']);
Route::get('/api/kotaGet/{param}', [UserController::class, 'kotaGet']);
Route::get('/api/costGet/{asal}/{tujuan}/{kurir}', [UserController::class, 'costGet']);

//AUTH
Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [AuthController::class, 'authLogin']);
Route::post('/logout', [AuthController::class, 'authLogout']);

//SOCIALITE
Route::get('/login/{provider}', [SocialController::class, 'redirect']);
Route::get('/login/{provider}/callback', [SocialController::class, 'Callback']);

//profilChange
Route::post('/profilChange', [UserController::class, 'profilChange']);

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/admin', AdminUserController::class);
    Route::get('/pembelian', [AdminController::class, 'pembelian']);
    Route::post('/pembelian/deletePemesanan', [AdminController::class, 'deletePembelian']);
    Route::post('/pembelian/updateResi', [AdminController::class, 'updateResi']);

    //PDF Print
    Route::get('/pembelianPDF/{jenis}', [AdminController::class, 'pembelianPdf']);
    Route::get('/produkPDF', [ProdukController::class, 'produkPdf']);
    Route::get('/kategoriPDF', [KategoriController::class, 'kategoriPdf']);
    Route::get('/accountPdf/{jenis}', [CustomerController::class, 'accountPdf']);
});
