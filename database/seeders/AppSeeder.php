<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Satker;
use App\Models\SubMenu;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Menu::create([
      'id' => 2,
      'name' => 'Data',
      'icon' => 'Code/Settings4.svg',
      'desc' => 'Menu Data',
      'has_submenu' => 1,
    ]);
    Menu::create([
      'id' => 3,
      'name' => 'Barang',
      'route' => 'barang.index',
      'icon' => 'Shopping/Box3.svg',
      'desc' => 'Menu Pengelolaan Barang',
      'has_submenu' => 0,
    ]);
    Menu::create([
      'id' => 4,
      'name' => 'Perencanaan',
      'route' => 'perencanaan.index',
      'icon' => 'Communication/Clipboard-list.svg',
      'desc' => 'Menu Perencanaan',
      'has_submenu' => 0,
    ]);

    SubMenu::insert([
      [
        'id' => 5,
        'menu_id' => 2,
        'name' => 'Unit Kerja',
        'route' => 'unit.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 6,
        'menu_id' => 2,
        'name' => 'Jenis Belanja',
        'route' => 'jenbel.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    DB::table('menu_role')->insert([
      ['menu_id' => 2, 'role_id' => 1],
      ['menu_id' => 3, 'role_id' => 1],
      ['menu_id' => 4, 'role_id' => 1],
    ]);

    // ------------------------------  ------------------------------ //

    Unit::create([
      'u_name' => 'Sekertariat Jenderal',
      'u_kode' => '-',
      'u_desc' => 'Sekertariat Jenderal',
    ]);
    Unit::create([
      'u_name' => 'Bimbingan Masyarakat Islam',
      'u_kode' => '-',
      'u_desc' => 'Bimbingan Masyarakat Islam',
    ]);

    // ------------------------------  ------------------------------ //

    $permissions = ['unit create', 'unit read', 'unit update', 'unit delete', 'unit multidelete'];
    $permissions = [...$permissions, ...['jenis_belanja create', 'jenis_belanja read', 'jenis_belanja update', 'jenis_belanja delete', 'jenis_belanja multidelete']];
    $permissions = [...$permissions, ...['barang create', 'barang read', 'barang update', 'barang delete', 'barang multidelete']];
    /*
    $permissions = [...$permissions, ...['create spesimen', 'read spesimen', 'update spesimen', 'delete spesimen', 'multidelete spesimen']];
    $permissions = [...$permissions, ...['create nomor', 'read nomor', 'update nomor', 'delete nomor', 'multidelete nomor', 'print nomor']];
    $permissions = [...$permissions, ...['create surat_masuk', 'read surat_masuk', 'update surat_masuk', 'delete surat_masuk', 'multidelete surat_masuk', 'print surat_masuk']];

    foreach ($permissions as $item) {
      Permission::create(['name' => $item]);
    }

    $role = Role::findByName('super admin');
    $role->givePermissionTo($permissions);

    // ------------------------------  ------------------------------ //

    $adminPermissions = [...['read menu', 'read permission', 'read role', 'create user', 'read user', 'update user', 'delete user', 'multidelete user'], ...$permissions];
    \App\Models\Role::create([
      'id' => 2,
      'name' => 'admin',
      'guard_name' => 'web',
      'desc' => 'Administrator',
    ]);
    $role = Role::findByName('admin');
    $role->givePermissionTo($adminPermissions);

    \App\Models\Role::create([
      'id' => 3,
      'name' => 'pimpinan',
      'guard_name' => 'web',
      'desc' => 'Pimpinan',
    ]);
    $role = Role::findByName('pimpinan');
    $role->givePermissionTo($adminPermissions);

    \App\Models\Role::create([
      'id' => 4,
      'name' => 'satker',
      'guard_name' => 'web',
      'desc' => 'Satuan Kerja',
    ]);
    $role = Role::findByName('satker');
    $role->givePermissionTo(['create nomor', 'read nomor', 'update nomor', 'delete nomor', 'print nomor', 'create surat_masuk', 'read surat_masuk', 'update surat_masuk', 'delete surat_masuk', 'multidelete surat_masuk', 'print surat_masuk']);

    // ------------------------------  ------------------------------ //

    DB::table('menu_role')->insert([
      ['menu_id' => 1, 'role_id' => 2],
      ['menu_id' => 2, 'role_id' => 2],
      ['menu_id' => 3, 'role_id' => 2],
      ['menu_id' => 4, 'role_id' => 2],

      ['menu_id' => 1, 'role_id' => 3],
      ['menu_id' => 2, 'role_id' => 3],
      ['menu_id' => 3, 'role_id' => 3],
      ['menu_id' => 4, 'role_id' => 3],

      ['menu_id' => 3, 'role_id' => 4],
      ['menu_id' => 4, 'role_id' => 4],
    ]);

    // ------------------------------  ------------------------------ //

    $admin = User::factory()->create([
      'id' => 2,
      'name' => 'Administrator',
      'email' => 'admin@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 2,
    ]);
    $admin->assignRole('admin');

    $pimpinan = User::factory()->create([
      'id' => 3,
      'name' => 'Kepala Kantor',
      'email' => 'pimpinan@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 3,
    ]);
    $pimpinan->assignRole('pimpinan');

    $satker = User::factory()->create([
      'id' => 4,
      'name' => 'Sekertariat Jenderal',
      'email' => 'sekjen@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 1,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 5,
      'name' => 'Bimbingan Masyarakat Islam',
      'email' => 'bimasislam@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 2,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 6,
      'name' => 'Pendidikan Islam',
      'email' => 'pendis@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 3,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 7,
      'name' => 'Penyelenggara Haji dan Umrah',
      'email' => 'phu@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 4,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 8,
      'name' => 'Penyelenggara Syariah Zakat dan Wakaf',
      'email' => 'zawa@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 5,
    ]);
    $satker->assignRole('satker');

    */
  }
}
