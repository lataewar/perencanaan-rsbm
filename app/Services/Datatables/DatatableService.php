<?php

namespace App\Services\Datatables;

class DatatableService
{
  //
  protected static function showBtn($id): string
  {
    $svg = file_get_contents("assets/media/svg/icons/General/Visible.svg");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2'
            onclick=\"show('" . $id . "')\"
            title='Detail'><span class='svg-icon svg-icon-md'>" . $svg . "</span></button>";
  }

  protected static function editBtnA($edit): string
  {
    $svg = file_get_contents("assets/media/svg/icons/Design/Edit.svg");
    return "<a href='$edit' class='btn btn-sm btn-clean btn-icon mr-2'
            title='Ubah Data'><span class='svg-icon svg-icon-md'>" . $svg . "</span></a>";
  }

  protected static function editBtn($id): string
  {
    $svg = file_get_contents("assets/media/svg/icons/Design/Edit.svg");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2'
            onclick=\"edit('" . $id . "')\"
            title='Ubah Data'><span class='svg-icon svg-icon-md'>" . $svg . "</span></button>";
  }

  public static function deleteBtn($id, $name): string
  {
    $svg = file_get_contents("assets/media/svg/icons/General/Trash.svg");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2'
            onclick=\"destroy('" . $id . "', '" . $name . "')\"
            title='Hapus Data'><span class='svg-icon svg-icon-md'>" . $svg . "</span></button>";
  }

  protected static function defaultBtn($fn, $id, $hint, $icon = "General/Unlock.svg"): string
  {
    $svg = file_get_contents("assets/media/svg/icons/$icon");
    return "<button type='button' class='btn btn-sm btn-clean btn-icon mr-2'
            onclick=\"$fn('$id')\"
            title='$hint'><span class='svg-icon svg-icon-md'>$svg</span></button>";
  }

  public static function btn($route, $hint, $icon = "Layout/Layout-top-panel-5.svg"): string
  {
    $svg = file_get_contents("assets/media/svg/icons/" . $icon);
    return "<a href='" . URL($route) . "' class='btn btn-sm btn-clean btn-icon mr-2'
            title='" . $hint . "'><span class='svg-icon svg-icon-md'>" . $svg . "</span></a>";
  }

  protected static function btnTargetBlank($route, $hint, $icon = "Files/File-done.svg"): string
  {
    $svg = file_get_contents("assets/media/svg/icons/" . $icon);
    return "<a href='" . $route . "' class='btn btn-sm btn-clean btn-icon mr-2' target='_blank'
            title='" . $hint . "'><span class='svg-icon svg-icon-md'>" . $svg . "</span></a>";
  }

  protected static function checkBox($id): string
  {
    return "<th><label class=\"checkbox checkbox-single\">
            <input type=\"checkbox\" class=\"check-id\" name=\"ids[]\" value=\"$id\"/>
            <span></span></label></th>";
  }

  protected static function label($name, $color = 'primary'): string
  {
    return "<span class='label label-light-" . $color . " font-weight-bold label-inline'>" . $name . "</span>";
  }

  protected static function icon($icon, $color = 'primary'): string
  {
    $svg = file_get_contents("assets/media/svg/icons/$icon");
    return "<span class='svg-icon svg-icon-lg svg-icon-$color'>$svg</span>";
  }

  public static function naviItem($route, $name, $icon = "la la-trash", $onClick = ""): string
  {
    return "<li class='navi-item'>
              <a href='$route' $onClick class='navi-link'>
                <span class='navi-icon'><i class='$icon'></i></span>
                <span class='navi-text'>$name</span>
              </a>
            </li>";
  }

  public static function navSeparator($margin = 2): string
  {
    return "<li class='navi-separator my-$margin'></li>";
  }

  public static function aksiDropdown($naviitems): string
  {

    return "
      <div class='dropdown dropdown-inline'>
        <a href='javascript:;' class='btn btn-sm btn-clean btn-icon mr-2' data-toggle='dropdown'>
          <span class='svg-icon svg-icon-md'>" . file_get_contents("assets/media/svg/icons/Code/Compiling.svg") . "</span>
        </a>
        <div class='dropdown-menu dropdown-menu-sm dropdown-menu-right'>
          <ul class='navi flex-column navi-hover py-2'>
            <li class='navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2'> Pilih Aksi: </li>
            $naviitems
          </ul>
        </div>
      </div>";
  }
}
