<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SiswaController;

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



route::middleware(['guest:siswa'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    route::post('/proseslogin',[AuthController::class,'proseslogin']);
    route::post('/prosesloginadmin',[AuthController::class,'prosesloginadmin']);
});
route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
});
Route::middleware(['auth:siswa'])->group(function()
{
    route::get('/dashboard',[DashboarController::class,'index']);
    Route::get('/proseslogout',[AuthController::class,'proseslogout']);

    //presensi
    route::get('/presensi/create',[PresensiController::class,'create']);
    route::post('/presensi/store',[PresensiController::class,'store']);

    //editprofile
    route::get('/editprofile',[PresensiController::class,'editprofile']);
    route::post('/presensi/{nis}/updateprofile',[PresensiController::class,'updateprofile']);

    //histori
    route::get('/presensi/histori',[PresensiController::class,'histori']);
    route::post('/gethistori',[PresensiController::class,'gethistori']);

    //izin
    route::get('/presensi/izin',[PresensiController::class,'izin']);
    route::get('/presensi/buatizin',[PresensiController::class,'buatizin']);
    route::post('/presensi/storeizin',[PresensiController::class,'storeizin']);
    //cek pengajuan izin
    route::post('/presensi/cekpengajuanizin',[PresensiController::class,'cekpengajuanizin']);
    
});

route::middleware('auth:user')->group (function(){
    Route::get('/proseslogoutadmin',[AuthController::class,'proseslogoutadmin']);
    route::get('/panel/dashboardadmin',[DashboarController::class,'dashboardadmin']);

    //siswa
    route::get('/siswa',[SiswaController::class,'index']);
    route::post('/siswa/store',[SiswaController::class,'store']);
    route::post('/siswa/edit',[SiswaController::class,'edit']); 
    route::post('/siswa/{nis}/update',[SiswaController::class,'update']);   
    route::post('/siswa/{nis}/delete',[SiswaController::class,'delete']);

    //jurusan
    route::get('/jurusan',[JurusanController::class,'index']);
    route::post('/jurusan/store',[JurusanController::class,'store']);
    route::post('/jurusan/edit',[JurusanController::class,'edit']);
    route::post('/jurusan/{kode_jurusan}/update',[JurusanController::class,'update']);
    route::post('/jurusan/{kode_jurusan}/delete',[JurusanController::class,'delete']);

    //presensi monitoring
    route::get('/presensi/monitoring',[PresensiController::class,'monitoring']);
    route::post('/getpresensi',[PresensiController::class,'getpresensi']);
    route::post('/tampilkanpeta',[PresensiController::class,'tampilkanpeta']);

    //laporan presensi
    route::get('/presensi/laporan',[PresensiController::class,'laporan']);
    route::post('/presensi/cetaklaporan',[PresensiController::class,'cetaklaporan']);
    route::get('/presensi/rekap',[PresensiController::class,'rekap']);
    route::post('/presensi/cetakrekap',[PresensiController::class,'cetakrekap']);

    //konfigurasi
    route::get('/konfigurasi/lokasikantor',[KonfigurasiController::class,'lokasikantor']);
    route::post('/konfigurasi/updatelokasikantor',[KonfigurasiController::class,'updatelokasikantor']);
    route::get('/konfigurasi/jambelajar',[KonfigurasiController::class,'jambelajar']);

    //izin dan sakit presensi
    route::get('/presensi/izinsakit',[PresensiController::class,'izinsakit']);
    route::post('/presensi/approveizinsakit',[PresensiController::class,'approveizinsakit']);
    route::get('/presensi/{id}/batalkanizinsakit',[PresensiController::class,'batalkanizinsakit']);

    
    
});

