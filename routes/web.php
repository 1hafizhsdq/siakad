<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\HerregistrasiController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleMenuController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Modul Role
    Route::resource('/role', RoleController::class);
    Route::get('/role-list', [RoleController::class, 'list'])->name('role-list');
    
    // Modul Menu
    Route::resource('/menu', MenuController::class);
    Route::get('/menu-list', [MenuController::class, 'list'])->name('menu-list');
    
    // modul Role Menu
    Route::get('/role-menu', [RoleMenuController::class, 'index'])->name('role-menu');
    Route::get('/role-menu-list', [RoleMenuController::class, 'list'])->name('role-menu-list');
    Route::get('/role-menu-status/{menuid}', [RoleMenuController::class, 'status'])->name('role-menu-status');
    Route::post('/role-menu-store', [RoleMenuController::class, 'store'])->name('role-menu-store');

    // Modul Fakultas
    Route::resource('/fakultas', FakultasController::class);
    Route::get('/fakultas-list', [FakultasController::class, 'list'])->name('fakultas-list');
    
    // Modul Ruangan
    Route::resource('/ruangan', RuanganController::class);
    Route::get('/ruangan-list', [RuanganController::class, 'list'])->name('ruangan-list');
    
    // Modul Tahun Ajaran
    Route::resource('/tahun-ajaran', TahunAjaranController::class);
    Route::get('/tahun-ajaran-list', [TahunAjaranController::class, 'list'])->name('tahun-ajaran-list');
    
    // Modul Prodi
    Route::resource('/prodi', ProdiController::class);
    Route::get('/prodi-list', [ProdiController::class, 'list'])->name('prodi-list');
    
    // Modul Matkul
    Route::resource('/matkul', MatkulController::class);
    Route::get('/matkul-list', [MatkulController::class, 'list'])->name('matkul-list');
    
    // Modul Pendaftaran
    Route::resource('/pendaftaran', PendaftaranController::class);
    Route::get('/pendaftaran-list/{prodi?}', [PendaftaranController::class, 'list'])->name('pendaftaran-list');
    Route::post('/pendaftaran-penerimaan', [PendaftaranController::class, 'penerimaan'])->name('pendaftaran-penerimaan');
    Route::get('/pendaftaran-pengumuman', [PendaftaranController::class, 'pengumuman'])->name('pendaftaran-pengumuman');
    Route::post('/pendaftaran-herregistrasi', [PendaftaranController::class, 'storeherregistrasi'])->name('pendaftaran-herregistrasi');
    
    // Modul Herregistrasi
    Route::resource('/herregistrasi', HerregistrasiController::class);
    Route::get('/herregistrasi-list/{tahunajaran?}/{prodi?}', [HerregistrasiController::class, 'list'])->name('herregistrasi-list');
    
    // Modul Akun Saya
    Route::get('/akun', [AkunController::class, 'index'])->name('akun');
    Route::post('/change-password', [AkunController::class, 'changePassword'])->name('change-password');
    
    // Modul User
    Route::resource('/user', UserController::class);
    Route::get('/user-list/{role}', [UserController::class, 'list'])->name('user-list');
    Route::get('/user-isactive', [UserController::class, 'isactive'])->name('user-isactive');
});