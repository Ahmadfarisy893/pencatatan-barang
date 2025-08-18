<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Master\PegawaiController;
use App\Http\Controllers\Master\CategoriesController;
use App\Http\Controllers\Master\BarangController;
use App\Http\Controllers\Master\PeminjamanController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/mail/welcome-email', [EmailController::class, 'sendWelcomeEmail'])->name('send-email');

// Google Authentication
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('login.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('auth/login', [AuthController::class, 'login'])->name('postLogin');
Route::get('auth/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('auth/register', [AuthController::class, 'register'])->name('postRegister');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');


// hanya Super Admin yang boleh akses users
Route::middleware(['auth', 'cekrole:Super Admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});

Route::prefix('pegawai')->group(function () {
    Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{id}/edit', [App\Http\Controllers\Master\PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{id}', [App\Http\Controllers\Master\PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [App\Http\Controllers\Master\PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    Route::get('/pegawai/{id}/view', [PegawaiController::class, 'view'])->name('pegawai.view');
});

route::prefix('categories')->group(function (){
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [App\Http\Controllers\Master\CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [App\Http\Controllers\Master\CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [App\Http\Controllers\Master\CategoriesController::class, 'destroy'])->name('categories.destroy');
});

route::prefix('barang')->group(function (){
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [App\Http\Controllers\Master\barangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [App\Http\Controllers\Master\barangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [App\Http\Controllers\Master\barangController::class, 'destroy'])->name('barang.destroy');
});


route::prefix('peminjaman')->group(function (){
    Route::get('/', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}/edit', [App\Http\Controllers\Master\PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id}', [App\Http\Controllers\Master\PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [App\Http\Controllers\Master\PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
});

route::get('/view', [App\Http\Controllers\ViewController::class, 'index'])->name('view');