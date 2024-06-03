<?php

use Carbon\Carbon;

if (!function_exists('activeMenu')) {
  function activeMenu($route, $type = 'menu')
  {
    if (!$route) return "";

    $currentPath = explode("/", request()->path())[0];
    $menuRoute = explode(".", $route)[0];
    if ($type == 'menu')
      return $menuRoute == $currentPath ? "menu-item-here menu-item-open" : "";
    if ($type == 'sub')
      return $menuRoute == $currentPath ? "menu-item-active" : "";
  }
}

function menuInit()
{
  $strMenu = "";
  if (session('menu')) {
    foreach (session('menu') as $menu) {
      $menuRoute = !$menu['route'] ? "#" : route($menu['route']);
      $menuName = $menu['name'];
      $menuActive = activeMenu($menu['route']);

      $menuToggle = "";
      $menuItemSub = "";
      $menuHasPopUp = "";
      $menuArrow = "";
      $strSubmenu = "";
      if ($menu['hs']) {
        $menuToggle = "menu-toggle";
        $menuItemSub = "menu-item-submenu";
        $menuHasPopUp = "data-menu-toggle='hover' aria-haspopup='true'";
        $menuArrow = "<i class='menu-arrow'></i>";

        $strSubmenu .= "<div class='menu-submenu'>
                        <ul class='menu-subnav'>";

        foreach ($menu['submenus'] as $submenu) {

          $submenuActive = activeMenu($submenu['route'], 'sub');
          if ($submenuActive == "menu-item-active") $menuActive = "menu-item-here menu-item-open";

          $strSubmenu .= "<li class='menu-item $submenuActive' aria-haspopup='true'>
                          <a href='" . route($submenu['route']) . "' class='menu-link'>
                            <i class='menu-bullet menu-bullet-dot'>
                              <span></span>
                            </i>
                            <span class='menu-text'>" . $submenu['name'] . "</span>
                            <span class='menu-desc'></span>
                          </a>
                        </li>";
        }

        $strSubmenu .= "</ul></div>";
      }

      // dd($menu['icon']);

      $icon = $menu['icon'] ?? "Design/Layers.svg";
      // dd($icon);

      $strMenu .= "<li class='menu-item $menuItemSub $menuActive' $menuHasPopUp>
                   <a href='$menuRoute' class='menu-link $menuToggle'>
                    <span class='svg-icon menu-icon'>" .
        file_get_contents("assets/media/svg/icons/" . $icon)
        . "</span>
                     <span class='menu-text'>$menuName</span>
                     $menuArrow
                   </a>
                   $strSubmenu
                 </li>";

      // dd($strMenu);
    }
  }
  return $strMenu;
}

function formatTanggal($date)
{
  return Carbon::createFromFormat('Y-m-d', $date)->isoFormat('D MMMM Y');
}

function formatTW($datetime)
{
  if (!$datetime) return "";
  return Carbon::parse($datetime)->translatedFormat('l\, d F Y \- \p\u\k\u\l H:i');
}

function formatTime($datetime)
{
  if (!$datetime) return "";
  return Carbon::parse($datetime)->translatedFormat('d M Y \- H:i');
}

function formatTDFH($datetime)
{
  if (!$datetime) return "";
  return Carbon::parse($datetime)->diffForHumans();
}

function formatNomor($nomor)
{
  return str_replace(',', '.', number_format((int) $nomor));
}
