<?php

namespace App\Services;

use App\Models\Role;

class MenuSessionService
{
  public function set_session(): void
  {
    // add menu to session
    $role = Role::find(auth()->user()->role_id);
    // parsing menu and submenu array
    $menus = [];
    foreach ($role->menus as $menu) {
      $array = [
        'id' => $menu->id,
        'name' => $menu->name,
        'route' => $menu->route,
        'icon' => $menu->icon,
        'hs' => $menu->has_submenu,
        'role_id' => $menu->pivot->role_id,
      ];

      if ($menu->has_submenu) {
        $submenus = [];
        foreach ($menu->subMenus as $submenu) {
          array_push($submenus, [
            'id' => $submenu->id,
            'name' => $submenu->name,
            'route' => $submenu->route,
            'icon' => $submenu->icon,
          ]);
        }
        if ($submenus)
          $array = $array + ['submenus' => $submenus];
      }

      array_push($menus, $array);
    }

    // Add menu and submenu array to session
    session()->put('menu', $menus);
  }
}
