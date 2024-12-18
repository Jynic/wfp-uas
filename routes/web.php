<?php

use App\Http\Controllers\Dinas;
use App\Http\Controllers\Fasum;
use App\Http\Controllers\Jenisfasum;
use App\Http\Controllers\Kota;
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

    Route::get('kota', [Kota::class, 'index'])->name('kota');
    Route::post('kota/simpan', [Kota::class, 'simpan'])->name('kota.simpan');
    Route::post('kota/getData', [Kota::class, 'getData'])->name('kota.getData');
    Route::post('kota/edit', [Kota::class, 'edit'])->name('kota.edit');
    Route::post('kota/hapus', [Kota::class, 'hapus'])->name('kota.hapus');
    Route::post('kota/update', [Kota::class, 'update'])->name('kota.update');
    Route::post('kota/getDataProvinsi', [Kota::class, 'getDataProvinsi'])->name('kota.getDataProvinsi');

    Route::get('dinas', [Dinas::class, 'index'])->name('dinas');
    Route::post('dinas/simpan', [Dinas::class, 'simpan'])->name('dinas.simpan');
    Route::post('dinas/getData', [Dinas::class, 'getData'])->name('dinas.getData');
    Route::post('dinas/edit', [Dinas::class, 'edit'])->name('dinas.edit');
    Route::post('dinas/hapus', [Dinas::class, 'hapus'])->name('dinas.hapus');
    Route::post('dinas/update', [Dinas::class, 'update'])->name('dinas.update');
    Route::post('dinas/getDataKota', [Dinas::class, 'getDataKota'])->name('dinas.getDataKota');

    Route::get('jenisfasum', [Jenisfasum::class, 'index'])->name('jenisfasum');
    Route::post('jenisfasum/simpan', [Jenisfasum::class, 'simpan'])->name('jenisfasum.simpan');
    Route::post('jenisfasum/getData', [Jenisfasum::class, 'getData'])->name('jenisfasum.getData');
    Route::post('jenisfasum/edit', [Jenisfasum::class, 'edit'])->name('jenisfasum.edit');
    Route::post('jenisfasum/hapus', [Jenisfasum::class, 'hapus'])->name('jenisfasum.hapus');
    Route::post('jenisfasum/update', [Jenisfasum::class, 'update'])->name('jenisfasum.update');
    Route::post('jenisfasum/getDataKota', [Jenisfasum::class, 'getDataKota'])->name('jenisfasum.getDataKota');

    Route::get('fasum', [Fasum::class, 'index'])->name('fasum');
    Route::post('fasum/simpan', [Fasum::class, 'simpan'])->name('fasum.simpan');
    Route::post('fasum/getData', [Fasum::class, 'getData'])->name('fasum.getData');
    Route::post('fasum/edit', [Fasum::class, 'edit'])->name('fasum.edit');
    Route::post('fasum/hapus', [Fasum::class, 'hapus'])->name('fasum.hapus');
    Route::post('fasum/update', [Fasum::class, 'update'])->name('fasum.update');
    Route::post('fasum/getDataKota', [Fasum::class, 'getDataKota'])->name('fasum.getDataKota');
});
