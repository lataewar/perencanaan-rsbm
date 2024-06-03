<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
  <!--begin::Menu Container-->
  <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
    data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    <ul class="menu-nav">
      <li class="menu-item {{ activeMenu('dashboard.index') }}" aria-haspopup="true">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:assets'/media/svg/icons/Design/Layers.svg-->
            {!! file_get_contents('assets/media/svg/icons/Design/Layers.svg') !!}
            <!--end::Svg Icon-->
          </span>
          <span class="menu-text">Dashboard</span>
        </a>
      </li>
      <li class="menu-section">
        <h4 class="menu-text">Menu</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
      </li>

      {!! menuInit() !!}

    </ul>
    <!--end::Menu Nav-->
  </div>
  <!--end::Menu Container-->
</div>
