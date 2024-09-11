<?php

use App\Http\Controllers\AlkesFormatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenbelController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SelectorController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\UsulController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

if (env('APP_DEBUG'))
  require __DIR__ . '/tes.php';

Route::get('/', function () {
  return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::post('/getjenbel', [SelectorController::class, 'getJenbel'])->name('selector.jenbel');
  Route::post('/getbarang', [SelectorController::class, 'getBarang'])->name('selector.barang');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

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

  Route::post('unit/datatable', [UnitController::class, 'datatable'])->name('unit.datatable');
  Route::post('unit/multdelete', [UnitController::class, 'multdelete'])->name('unit.multdelete');
  Route::resource('unit', UnitController::class)->except('show');

  Route::post('bidang/datatable', [BidangController::class, 'datatable'])->name('bidang.datatable');
  Route::get('bidang/{bidang}/unit', [BidangController::class, 'createUnits'])->name('bidang.unit');
  Route::post('bidang/{bidang}/unit', [BidangController::class, 'syncUnits'])->name('bidang.sync');
  Route::resource('bidang', BidangController::class)->except('show');

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

  Route::prefix('barang')->group(function () {
    Route::get('/choose_belanja', [BarangController::class, 'setbelanja'])->name('barang.getbelanja');
    Route::post('/choose_belanja', [BarangController::class, 'setbelanja'])->name('barang.setbelanja');
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/datatable', [BarangController::class, 'datatable'])->name('barang.datatable');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/update/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::post('/multdelete', [BarangController::class, 'multdelete'])->name('barang.multdelete');
  });

  Route::prefix('alkes')->group(function () {
    Route::get('/', [AlkesFormatController::class, 'index'])->name('alkes.index');
    Route::post('/datatable', [AlkesFormatController::class, 'datatable'])->name('alkes.datatable');
  });

  Route::prefix('perencanaan')->group(function () {
    Route::get('/', [PerencanaanController::class, 'index'])->name('perencanaan.index');
    Route::post('/setfilter', [PerencanaanController::class, 'setfilter'])->name('perencanaan.setfilter');
    Route::delete('/', [PerencanaanController::class, 'destroy'])->name('perencanaan.destroy');
    Route::post('/multdelete', [PerencanaanController::class, 'multdelete'])->name('perencanaan.multdelete');
    Route::get('/{perencanaan}/belanja', [PerencanaanController::class, 'belanja'])->name('perencanaan.belanja');
    Route::post('/accept', [PerencanaanController::class, 'accept'])->name('perencanaan.accept');
    Route::post('/validate', [PerencanaanController::class, 'validasi'])->name('perencanaan.validate');
    Route::post('/reject', [PerencanaanController::class, 'reject'])->name('perencanaan.reject');

    Route::prefix('belanja')->group(function () {
      Route::get('/', [BelanjaController::class, 'index'])->name('belanja.index');
      Route::post('/datatable', [BelanjaController::class, 'datatable'])->name('belanja.datatable');
      Route::get('/cbu/{usulan}', [BelanjaController::class, 'createByUsulan'])->name('belanja.create.usulan');
      Route::post('/cbu', [BelanjaController::class, 'storeByUsulan'])->name('belanja.store.usulan');
      Route::get('/create', [BelanjaController::class, 'create'])->name('belanja.create');
      Route::post('/store', [BelanjaController::class, 'store'])->name('belanja.store');
      Route::delete('/', [BelanjaController::class, 'destroy'])->name('belanja.destroy');
      Route::get('/{pivot}/edit', [BelanjaController::class, 'edit'])->name('belanja.edit');
      Route::put('/update/{pivot}', [BelanjaController::class, 'update'])->name('belanja.update');

      Route::get('/{id}/cetak', [CetakController::class, 'cetak_perencanaan'])->name('perencanaan.cetak');
    });
  });

  Route::prefix('usulan')->group(function () {
    Route::get('/', [UsulanController::class, 'index'])->name('usulan.index');
    Route::post('/setfilter', [UsulanController::class, 'setfilter'])->name('usulan.setfilter');
    Route::get('/{usul}/usul', [UsulanController::class, 'usul'])->name('usulan.usul');
    Route::get('/create', [UsulanController::class, 'create'])->name('usulan.create');
    Route::post('/', [UsulanController::class, 'store'])->name('usulan.store');
    Route::delete('/', [UsulanController::class, 'destroy'])->name('usulan.destroy');
    Route::post('/send', [UsulanController::class, 'send'])->name('usulan.send');

    Route::get('/{id}/cetak', [CetakController::class, 'cetak_usulan'])->name('usulan.cetak');

    Route::prefix('unit')->group(function () {
      Route::get('/', [UsulController::class, 'index'])->name('usul.index');
      Route::post('/datatable', [UsulController::class, 'datatable'])->name('usul.datatable');
      Route::get('/create', [UsulController::class, 'create'])->name('usul.create');
      Route::post('/store', [UsulController::class, 'store'])->name('usul.store');
      Route::get('/{usul}/edit', [UsulController::class, 'edit'])->name('usul.edit');
      Route::put('/update/{usul}', [UsulController::class, 'update'])->name('usul.update');
      Route::delete('/{usul}', [UsulController::class, 'destroy'])->name('usul.destroy');
      Route::post('/multdelete', [UsulController::class, 'multdelete'])->name('usul.multdelete');
    });
  });
});
