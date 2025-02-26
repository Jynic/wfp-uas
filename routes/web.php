<?php

use App\Http\Controllers\Dinas;
use App\Http\Controllers\Fasum;
use App\Http\Controllers\Hakakses;
use App\Http\Controllers\Historypelaporan;
use App\Http\Controllers\Jenisfasum;
use App\Http\Controllers\Kota;
use App\Http\Controllers\Pelaporan;
use App\Http\Controllers\Pelaporanadmin;
use App\Http\Controllers\Provinsi;
use App\Http\Controllers\Staff;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name(name: 'home');

Route::middleware('auth')->group(function () {

    // route halaman & query untuk dashboard
    Route::get('/', function () {
        return view('dashboard_v');
    })->middleware('can:accessStaffPages');
    Route::get('/home', function () {
        return view('dashboard_v');
    })->name('home')->middleware('can:accessStaffPages');

    Route::post('fasum/getFasumRusak', [Fasum::class, 'getFasumRusak'])->name('fasum.getFasumRusak');
    Route::get('get-kategori-fasum', [Fasum::class, 'getKategoriFasum'])->name('fasum.getKategoriFasum');
    Route::post('pelaporan/belum-selesai', [Pelaporan::class, 'getPelaporanBelumSelesai'])->name('pelaporan.getPelaporanBelumSelesai');
    Route::post('pelaporan/detailBelumSelesai', [Pelaporan::class, 'detailBelumSelesai'])->name('pelaporan.detailBelumSelesai');
    Route::post('user/sering-mengadu', [User::class, 'getUserSeringMengadu'])->name('user.getUserSeringMengadu');

    Route::get('provinsi', [Provinsi::class, 'index'])->name('provinsi')->middleware('can:accessAdminPages');
    Route::post('provinsi/simpan', [Provinsi::class, 'simpan'])->name('provinsi.simpan');
    Route::post('provinsi/getData', [Provinsi::class, 'getData'])->name('provinsi.getData');
    Route::post('provinsi/edit', [Provinsi::class, 'edit'])->name('provinsi.edit');
    Route::post('provinsi/hapus', [Provinsi::class, 'hapus'])->name('provinsi.hapus');
    Route::post('provinsi/update', [Provinsi::class, 'update'])->name('provinsi.update');

    Route::get('kota', [Kota::class, 'index'])->name('kota')->middleware('can:accessAdminPages');
    Route::post('kota/simpan', [Kota::class, 'simpan'])->name('kota.simpan');
    Route::post('kota/getData', [Kota::class, 'getData'])->name('kota.getData');
    Route::post('kota/edit', [Kota::class, 'edit'])->name('kota.edit');
    Route::post('kota/hapus', [Kota::class, 'hapus'])->name('kota.hapus');
    Route::post('kota/update', [Kota::class, 'update'])->name('kota.update');
    Route::post('kota/getDataProvinsi', [Kota::class, 'getDataProvinsi'])->name('kota.getDataProvinsi');

    Route::get('dinas', [Dinas::class, 'index'])->name('dinas')->middleware('can:accessAdminPages');
    Route::post('dinas/simpan', [Dinas::class, 'simpan'])->name('dinas.simpan');
    Route::post('dinas/getData', [Dinas::class, 'getData'])->name('dinas.getData');
    Route::post('dinas/edit', [Dinas::class, 'edit'])->name('dinas.edit');
    Route::post('dinas/hapus', [Dinas::class, 'hapus'])->name('dinas.hapus');
    Route::post('dinas/update', [Dinas::class, 'update'])->name('dinas.update');
    Route::post('dinas/getDataKota', [Dinas::class, 'getDataKota'])->name('dinas.getDataKota');

    Route::get('jenisfasum', [Jenisfasum::class, 'index'])->name('jenisfasum')->middleware('can:accessStaffPages');
    Route::post('jenisfasum/simpan', [Jenisfasum::class, 'simpan'])->name('jenisfasum.simpan');
    Route::post('jenisfasum/getData', [Jenisfasum::class, 'getData'])->name('jenisfasum.getData');
    Route::post('jenisfasum/edit', [Jenisfasum::class, 'edit'])->name('jenisfasum.edit');
    Route::post('jenisfasum/hapus', [Jenisfasum::class, 'hapus'])->name('jenisfasum.hapus');
    Route::post('jenisfasum/update', [Jenisfasum::class, 'update'])->name('jenisfasum.update');
    Route::post('jenisfasum/getDataKota', [Jenisfasum::class, 'getDataKota'])->name('jenisfasum.getDataKota');

    Route::get('fasum', [Fasum::class, 'index'])->name('fasum')->middleware('can:accessStaffPages');
    Route::post('fasum/simpan', [Fasum::class, 'simpan'])->name('fasum.simpan');
    Route::post('fasum/getData', [Fasum::class, 'getData'])->name('fasum.getData');
    Route::post('fasum/getDataByDinas', [Fasum::class, 'getDataByDinas'])->name('fasum.getDataByDinas');
    Route::post('fasum/edit', [Fasum::class, 'edit'])->name('fasum.edit');
    Route::post('fasum/hapus', [Fasum::class, 'hapus'])->name('fasum.hapus');
    Route::post('fasum/update', [Fasum::class, 'update'])->name('fasum.update');
    Route::post('fasum/getDataKategori', [Fasum::class, 'getDataKategori'])->name('fasum.getDataKategori');
    Route::post('fasum/getDataDinas', [Fasum::class, 'getDataDinas'])->name('fasum.getDataDinas');


    Route::get('staff', [Staff::class, 'index'])->name('staff')->middleware('can:accessManajerPages');
    Route::post('staff/simpan', [Staff::class, 'simpan'])->name('staff.simpan');
    Route::post('staff/getData', [Staff::class, 'getData'])->name('staff.getData');
    Route::post('staff/edit', [Staff::class, 'edit'])->name('staff.edit');
    Route::post('staff/hapus', [Staff::class, 'hapus'])->name('staff.hapus');
    Route::post('staff/update', [Staff::class, 'update'])->name('staff.update');
    Route::post('staff/getDataJabatan', [Staff::class, 'getDataJabatan'])->name('staff.getDataJabatan');
    Route::post('staff/getDataDinas', [Staff::class, 'getDataDinas'])->name('staff.getDataDinas');

    Route::get('user', [User::class, 'index'])->name('user')->middleware('can:accessManajerPages');
    Route::post('user/simpan', [User::class, 'simpan'])->name('user.simpan');
    Route::post('user/getData', [User::class, 'getData'])->name('user.getData');
    Route::post('user/edit', [User::class, 'edit'])->name('user.edit');
    Route::post('user/hapus', [User::class, 'hapus'])->name('user.hapus');
    Route::post('user/update', [User::class, 'update'])->name('user.update');
    Route::post('user/getDataJabatan', [User::class, 'getDataJabatan'])->name('user.getDataJabatan');
    Route::post('user/getKota', [User::class, 'getKota'])->name('user.getKota');

    Route::get('pelaporan', [Pelaporan::class, 'index'])->name('pelaporan')->middleware('can:accessStaffPages');
    Route::post('pelaporan/simpan', [Pelaporan::class, 'simpan'])->name('pelaporan.simpan');
    Route::post('pelaporan/getData', [Pelaporan::class, 'getData'])->name('pelaporan.getData');
    Route::post('pelaporan/edit', [Pelaporan::class, 'edit'])->name('pelaporan.edit');
    Route::post('pelaporan/detail', [Pelaporan::class, 'detail'])->name('pelaporan.detail');
    Route::post('pelaporan/hapus', [Pelaporan::class, 'hapus'])->name('pelaporan.hapus');
    Route::post('pelaporan/update', [Pelaporan::class, 'update'])->name('pelaporan.update');
    Route::post('pelaporan/getDataStaff', [Pelaporan::class, 'getDataStaff'])->name('pelaporan.getDataStaff');
    Route::post('pelaporan/getDataUser', [Pelaporan::class, 'getDataUser'])->name('pelaporan.getDataUser');
    Route::post('pelaporan/getDataFasum', [Pelaporan::class, 'getDataFasum'])->name('pelaporan.getDataFasum');
    Route::get('pelaporan/GetNomor', [Pelaporan::class, 'GetNomor'])->name('pelaporan.GetNomor');
    Route::get('pelaporan/assignStaff/{pelaporan_id}/{staff_id}', [Pelaporan::class, 'assignStaff'])->name('pelaporan.assignStaff')->middleware('can:accessManajerPages');
    Route::get('pelaporan/updateStatus/{pelaporan_id}/{state}', [Pelaporan::class, 'ubahState'])->name('pelaporan.updateStatus')->middleware('can:accessStaffPages');

    Route::get('historypelaporan', [Historypelaporan::class, 'index'])->name('historypelaporan')->middleware('can:accessStaffPages');
    Route::post('historypelaporan/getData', [Historypelaporan::class, 'getData'])->name('historypelaporan.getData');
    Route::post('/historypelaporan/updateKeterangan', [Historypelaporan::class, 'updateKeterangan'])->name('historypelaporan.updateKeterangan');

    Route::get('pelaporanku', [Pelaporan::class, 'indexUser'])->name('pelaporanku')->middleware('can:accessUserPages');
    Route::post('pelaporanku/getDataForUser', [Pelaporan::class, 'getDataForUser'])->name('pelaporanku.getDataForUser');
    Route::post('pelaporanku/getDataFasum', [Pelaporan::class, 'getDataFasumForUser'])->name('pelaporanku.getDataFasumForUser');
});
