<div class='dropdown dropdown-inline'>
  <a href='javascript:;' class='btn btn-sm btn-clean btn-icon mr-2' data-toggle='dropdown'>
    <span class='svg-icon svg-icon-md'>{!! file_get_contents('assets/media/svg/icons/Code/Compiling.svg') !!}</span>
  </a>
  <div class='dropdown-menu dropdown-menu-sm dropdown-menu-right'>
    <ul class='navi flex-column navi-hover py-2'>
      <li class='navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2'> Pilih Aksi: </li>
      {{ $slot }}
    </ul>
  </div>
</div>
