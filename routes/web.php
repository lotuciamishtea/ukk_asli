<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\KeluarController;

Route::get('/', function () {
    return view('/dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('barangmasuk', MasukController::class);
    Route::resource('barangkeluar', KeluarController::class);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/search', [BarangController::class, 'search'])->name('search');

// Rute untuk detail produk


// Rute untuk halaman dashboard

