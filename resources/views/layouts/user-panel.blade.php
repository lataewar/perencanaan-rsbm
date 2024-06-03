<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
  <!--begin::Header-->
  <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
    <h3 class="font-weight-bold m-0">Profil Pengguna
    </h3>
    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
      <i class="ki ki-close icon-xs text-muted"></i>
    </a>
  </div>
  <!--end::Header-->
  <!--begin::Content-->
  <div class="offcanvas-content pr-5 mr-n5">
    <!--begin::Header-->
    <div class="d-flex align-items-center mt-5">
      <div class="symbol symbol-100 mr-5">
        <div class="symbol-label" style="background-image:url('{{ asset('assets') }}/media/users/blank.png')"></div>
      </div>
      <div class="d-flex flex-column">
        <a href="#"
          class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ auth()->user()->name }}</a>
        <div class="text-muted mt-1">{!! auth()->user()->role_id->getLabelHTML() !!}</div>
        <div class="navi mt-2">
          <a href="#" class="navi-item">
            <span class="navi-link p-0 pb-2">
              <span class="navi-icon mr-1">
                <span class="svg-icon svg-icon-lg svg-icon-primary">
                  {!! file_get_contents('assets/media/svg/icons/Communication/Mail.svg') !!}
                </span>
              </span>
              <span class="navi-text text-muted text-hover-primary">{{ auth()->user()->email }}</span>
            </span>
          </a>
          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
              onclick="event.preventDefault();this.closest('form').submit();">
              Sign Out
            </a>
          </form>
        </div>
      </div>
    </div>
    <!--end::Header-->
    <!--begin::Separator-->
    <div class="separator separator-dashed mt-8 mb-5"></div>
    <!--end::Separator-->
    <!--begin::Nav-->
    <div class="navi navi-spacer-x-0 p-0">
      <!--begin::Item-->
      <a href="{{ route('profile.edit') }}" class="navi-item">
        <div class="navi-link">
          <div class="symbol symbol-40 bg-light mr-3">
            <div class="symbol-label">
              <span class="svg-icon svg-icon-md svg-icon-success">
                {!! file_get_contents('assets/media/svg/icons/General/Notification2.svg') !!}
              </span>
            </div>
          </div>
          <div class="navi-text">
            <div class="font-weight-bold">Profil Saya</div>
            <div class="text-muted">Pengaturan Akun dll.
            </div>
          </div>
        </div>
      </a>
      <!--end:Item-->
    </div>
    <!--end::Nav-->
    <!--begin::Separator-->
    <div class="separator separator-dashed my-7"></div>
    <!--end::Separator-->
  </div>
  <!--end::Content-->
</div>
