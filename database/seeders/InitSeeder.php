<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitSeeder extends Seeder
{
  public function run(): void
  {
    \App\Models\Role::create([
      'id' => 1,
      'name' => 'super admin',
      'guard_name' => 'web',
      'desc' => 'Super Administrator',
    ]);

    Menu::create([
      'id' => 1,
      'name' => 'DEV',
      'icon' => 'Code/Code.svg',
      'desc' => 'Menu Development',
      'has_submenu' => 1,
    ]);

    SubMenu::insert([
      [
        'id' => 1,
        'menu_id' => 1,
        'name' => 'Menu',
        'route' => 'menu.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 2,
        'menu_id' => 1,
        'name' => 'Permission',
        'route' => 'permission.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 3,
        'menu_id' => 1,
        'name' => 'Role',
        'route' => 'role.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 4,
        'menu_id' => 1,
        'name' => 'User',
        'route' => 'user.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    DB::table('menu_role')->insert(['menu_id' => 1, 'role_id' => 1]);

    $user = User::factory()->create([
      'name' => 'Super Admin',
      'email' => 'supadmin@admin.com',
      'password' => Hash::make('zzzzzzzz'),
      'role_id' => 1,
    ]);
    $user->assignRole('super admin');

    $permissions = ['menu create', 'menu read', 'menu update', 'menu delete'];
    $permissions = [...$permissions, ...['permission create', 'permission read', 'permission update', 'permission delete', 'permission multidelete']];
    $permissions = [...$permissions, ...['role create', 'role read', 'role update', 'role delete', 'role setakses', 'role setpermission']];
    $permissions = [...$permissions, ...['user create', 'user read', 'user update', 'user delete', 'user multidelete']];

    foreach ($permissions as $item) {
      Permission::create(['name' => $item]);
    }

    $role = Role::findByName('super admin');
    $role->givePermissionTo($permissions);

  }
}
