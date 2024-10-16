<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppSeeder extends Seeder
{
  public function run(): void
  {
    // ---------------------------- SEEDING MENU ---------------------------- //

    Menu::create([
      'id' => 3,
      'name' => 'Data',
      'icon' => 'Code/Settings4.svg',
      'desc' => 'Menu Data',
      'has_submenu' => 1,
    ]);
    Menu::create([
      'id' => 4,
      'name' => 'Alat Kesehatan',
      'route' => 'alkes.index',
      'icon' => 'Devices/Diagnostics.svg',
      'desc' => 'Menu Alat Kesehatan',
      'has_submenu' => 0,
    ]);
    Menu::create([
      'id' => 5,
      'name' => 'Barang',
      'route' => 'barang.index',
      'icon' => 'Shopping/Box3.svg',
      'desc' => 'Menu Pengelolaan Barang',
      'has_submenu' => 0,
    ]);
    Menu::create([
      'id' => 6,
      'name' => 'Usulan',
      'route' => 'usulan.index',
      'icon' => 'Tools/Pantone.svg',
      'desc' => 'Menu Usulan Unit',
      'has_submenu' => 0,
    ]);
    Menu::create([
      'id' => 7,
      'name' => 'Perencanaan',
      'route' => 'perencanaan.index',
      'icon' => 'Communication/Clipboard-list.svg',
      'desc' => 'Menu Perencanaan',
      'has_submenu' => 0,
    ]);

    SubMenu::insert([
      [
        'id' => 4,
        'menu_id' => 3,
        'name' => 'Unit Kerja',
        'route' => 'unit.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 5,
        'menu_id' => 3,
        'name' => 'Bidang',
        'route' => 'bidang.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 6,
        'menu_id' => 3,
        'name' => 'Jenis Belanja',
        'route' => 'jenbel.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 7,
        'menu_id' => 3,
        'name' => 'Periode',
        'route' => 'periode.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    DB::table('menu_role')->insert([
      ['menu_id' => 3, 'role_id' => 1],
      ['menu_id' => 4, 'role_id' => 1],
      ['menu_id' => 5, 'role_id' => 1],
      ['menu_id' => 6, 'role_id' => 1],
      ['menu_id' => 7, 'role_id' => 1],
    ]);

    // ---------------------------- SEEDING ROLE ---------------------------- //

    \App\Models\Role::create([
      'id' => 2,
      'name' => 'administrator',
      'guard_name' => 'web',
      'desc' => 'Administrator',
    ])->menus()->attach([2, 3, 4, 5, 6, 7]);
    \App\Models\Role::create([
      'id' => 3,
      'name' => 'pimpinan',
      'guard_name' => 'web',
      'desc' => 'Pimpinan',
    ])->menus()->attach([2, 4, 7]);
    \App\Models\Role::create([
      'id' => 4,
      'name' => 'perencana',
      'guard_name' => 'web',
      'desc' => 'Perencana',
    ])->menus()->attach([3, 4, 5, 7]);
    \App\Models\Role::create([
      'id' => 5,
      'name' => 'unit',
      'guard_name' => 'web',
      'desc' => 'Unit',
    ])->menus()->attach([4, 5, 6, 7]);
    \App\Models\Role::create([
      'id' => 6,
      'name' => 'bidang',
      'guard_name' => 'web',
      'desc' => 'Bidang',
    ])->menus()->attach([7]);


    // ------------------------ SEEDING PERMISSION  ------------------------ //

    $p_users = ['user create', 'user read', 'user update', 'user delete', 'user multidelete'];
    $p_units = ['unit_kerja create', 'unit_kerja read', 'unit_kerja update', 'unit_kerja delete', 'unit_kerja multidelete'];
    $p_bidangs = ['bidang create', 'bidang read', 'bidang update', 'bidang delete', 'bidang unit'];
    $p_jenbels = ['jenis_belanja create', 'jenis_belanja read', 'jenis_belanja update', 'jenis_belanja delete', 'jenis_belanja multidelete'];
    $p_barangs = ['barang create', 'barang read', 'barang update', 'barang delete', 'barang multidelete'];
    $p_perencanaans = ['perencanaan create', 'perencanaan read', 'perencanaan update', 'perencanaan delete', 'perencanaan send', 'perencanaan validate', 'perencanaan accept', 'perencanaan reject'];
    $p_periodes = ['periode create', 'periode read', 'periode update', 'periode delete'];

    foreach ([...$p_units, ...$p_bidangs, ...$p_jenbels, ...$p_barangs, ...$p_perencanaans, ...$p_periodes] as $item) {
      Permission::create(['name' => $item]);
    }

    $super_admin = Role::findByName('super admin');
    $super_admin->givePermissionTo([
      ...$p_units,
      ...$p_bidangs,
      ...$p_jenbels,
      ...$p_barangs,
      ...['perencanaan read']
    ]);

    $administrator = Role::findByName('administrator');
    $administrator->givePermissionTo([
      ...$p_users,
      ...$p_units,
      ...$p_bidangs,
      ...$p_jenbels,
      ...$p_barangs,
      ...['perencanaan read']
    ]);

    $pimpinan = Role::findByName('pimpinan');
    $pimpinan->givePermissionTo(['user read', 'perencanaan read']);

    $perencana = Role::findByName('perencana');
    $perencana->givePermissionTo([
      ...$p_units,
      ...$p_jenbels,
      ...$p_barangs,
      ...$p_periodes,
      ...['perencanaan read', 'perencanaan update', 'perencanaan delete', 'perencanaan accept', 'perencanaan reject']
    ]);

    $unit = Role::findByName('unit');
    $unit->givePermissionTo([
      ...$p_barangs,
      ...['perencanaan create', 'perencanaan read', 'perencanaan update', 'perencanaan delete', 'perencanaan send']
    ]);

    $bidang = Role::findByName('bidang');
    $bidang->givePermissionTo([
      ...['perencanaan read', 'perencanaan update', 'perencanaan delete', 'perencanaan validate', 'perencanaan reject']
    ]);

  }
}
