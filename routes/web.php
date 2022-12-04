<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', [BerandaController::class, 'index']);
Route::resource('beranda', BerandaController::class);

Route::middleware(['auth', 'admin'])->group(function () {

    // datauser
    Route::resource('datauser', UserController::class);
    Route::get('deleteuser/{id}', [UserController::class, 'destroy'])->name('deleteuser');

    // kategori
    Route::resource('kategori', KategoriController::class);
    Route::get('deletekategori/{kategori}', [KategoriController::class, 'destroy'])->name('deletekategori');
});

Route::middleware(['auth', 'editor'])->group(function () {

    // buku
    Route::resource('buku', BukuController::class);
    Route::get('deletebuku/{buku}', [BukuController::class, 'destroy'])->name('deletebuku');
});





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
