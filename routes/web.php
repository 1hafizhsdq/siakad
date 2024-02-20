<?php

use App\Http\Controllers\FakultasController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleMenuController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TahunAjaranController;
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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
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
    
    // Modul Ruangan
    Route::resource('/tahun-ajaran', TahunAjaranController::class);
    Route::get('/tahun-ajaran-list', [TahunAjaranController::class, 'list'])->name('tahun-ajaran-list');
});