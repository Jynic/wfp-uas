<?php

use App\Http\Controllers\Provinsi;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard_v');
    });
    Route::get('provinsi', [Provinsi::class, 'index'])->name('provinsi');
    Route::post('provinsi/simpan', [Provinsi::class, 'simpan'])->name('provinsi.simpan');
    Route::post('provinsi/getData', [Provinsi::class, 'getData'])->name('provinsi.getData');
    Route::post('provinsi/edit', [Provinsi::class, 'edit'])->name('provinsi.edit');
    Route::post('provinsi/hapus', [Provinsi::class, 'hapus'])->name('provinsi.hapus');
    Route::post('provinsi/update', [Provinsi::class, 'update'])->name('provinsi.update');
});
