<!--begin::Alert-->
<div class="alert alert-custom alert-light-{{ $color }} fade show mb-5" role="alert">
  <div class="alert-icon">
    <span class="svg-icon svg-icon-3x svg-icon-{{ $color }}">
      {!! file_get_contents('assets/media/svg/icons/Code/Info-circle.svg') !!}
    </span>
  </div>
  <div class="alert-text font-weight-bold">
    {!! $slot !!}
  </div>
  <div class="alert-close">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">
        <i class="ki ki-close"></i>
      </span>
    </button>
  </div>
</div>
<!--end::Alert-->
