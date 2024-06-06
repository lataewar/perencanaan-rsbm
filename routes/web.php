<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenbelController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/tes.php';

Route::get('/', function () {
  return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

  // start PROTECTED ROLE -> super admin, admin, pimpinan
  Route::group(['middleware' => ['role:super admin|admin|pimpinan']], function () {
    Route::post('menu/datatable', [MenuController::class, 'datatable'])->name('menu.datatable');
    Route::resource('menu', MenuController::class)->except('show');

    Route::prefix('menu/submenu/{menu}')->group(function () {
      Route::get('/', [SubMenuController::class, 'index'])->name('submenu.index');
      Route::post('/datatable', [SubMenuController::class, 'datatable'])->name('submenu.datatable');
      Route::get('/create', [SubMenuController::class, 'create'])->name('submenu.create');
      Route::post('/store', [SubMenuController::class, 'store'])->name('submenu.store');
      Route::get('/{submenu}/edit', [SubMenuController::class, 'edit'])->name('submenu.edit');
      Route::put('/update/{submenu}', [SubMenuController::class, 'update'])->name('submenu.update');
      Route::delete('/{submenu}', [SubMenuController::class, 'destroy'])->name('submenu.destroy');
    });

    Route::post('user/datatable', [UserController::class, 'datatable'])->name('user.datatable');
    Route::post('user/multdelete', [UserController::class, 'multdelete'])->name('user.multdelete');
    Route::resource('user', UserController::class)->except('show');

    Route::post('permission/datatable', [PermissionController::class, 'datatable'])->name('permission.datatable');
    Route::post('permission/multdelete', [PermissionController::class, 'multdelete'])->name('permission.multdelete');
    Route::resource('permission', PermissionController::class)->except('show');

    Route::post('role/datatable', [RoleController::class, 'datatable'])->name('role.datatable');
    Route::get('role/{role}/akses', [RoleController::class, 'createAkses'])->name('role.akses');
    Route::post('role/{role}/akses', [RoleController::class, 'syncAkses'])->name('akses.sync');
    Route::get('role/{role}/permission', [RoleController::class, 'createPermission'])->name('role.permission');
    Route::post('role/{role}/permission', [RoleController::class, 'syncPermission'])->name('permission.sync');
    Route::resource('role', RoleController::class)->except('show');
  });
  // end PROTECTED ROLE -> super admin, admin, pimpinan

  Route::post('unit/datatable', [UnitController::class, 'datatable'])->name('unit.datatable');
  Route::post('unit/multdelete', [UnitController::class, 'multdelete'])->name('unit.multdelete');
  Route::resource('unit', UnitController::class)->except('show');

  Route::prefix('jenbel/{parent?}')->group(function () {
    Route::get('/', [JenbelController::class, 'index'])->name('jenbel.index');
    Route::post('/datatable', [JenbelController::class, 'datatable'])->name('jenbel.datatable');
    Route::get('/create', [JenbelController::class, 'create'])->name('jenbel.create');
    Route::post('/store', [JenbelController::class, 'store'])->name('jenbel.store');
    Route::get('/{jenbel}/edit', [JenbelController::class, 'edit'])->name('jenbel.edit');
    Route::put('/update/{jenbel}', [JenbelController::class, 'update'])->name('jenbel.update');
    Route::delete('/{jenbel}', [JenbelController::class, 'destroy'])->name('jenbel.destroy');
    Route::post('/multdelete', [JenbelController::class, 'multdelete'])->name('jenbel.multdelete');
  });

  Route::prefix('barang/{id?}')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/datatable', [BarangController::class, 'datatable'])->name('barang.datatable');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/update/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::post('/multdelete', [BarangController::class, 'multdelete'])->name('barang.multdelete');
  });
});
