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
    ]);

    Menu::create([
      'id' => 2,
      'name' => 'Pengguna',
      'route' => 'user.index',
      'icon' => 'General/User.svg',
      'desc' => 'Menu User',
      'has_submenu' => 0,
    ]);

    DB::table('menu_role')->insert([
      ['menu_id' => 1, 'role_id' => 1],
      ['menu_id' => 2, 'role_id' => 1]
    ]);

    $user = User::factory()->create([
      'id' => '6ac07c67-3c3f-4ebf-a9b0-c491955241cd',
      'name' => 'Super Admin',
      'email' => 'supadmin@admin.com',
      'password' => Hash::make('zzzzzzzz'),
      'role_id' => 1,
    ]);
    $user->assignRole('super admin');

    $p_menus = ['menu create', 'menu read', 'menu update', 'menu delete'];
    $p_permissions = ['permission create', 'permission read', 'permission update', 'permission delete', 'permission multidelete'];
    $p_roles = ['role create', 'role read', 'role update', 'role delete', 'role setakses', 'role setpermission'];
    $p_users = ['user create', 'user read', 'user update', 'user delete', 'user multidelete'];

    $permissions = [...$p_menus, ...$p_permissions, ...$p_roles, ...$p_users];

    foreach ($permissions as $item) {
      Permission::create(['name' => $item]);
    }

    $role = Role::findByName('super admin');
    $role->givePermissionTo($permissions);

  }
}
