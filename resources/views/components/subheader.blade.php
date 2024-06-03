<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->

    <div class="d-flex align-items-center flex-wrap mr-2">
      <!--begin::Page Title-->
      <h5 class="text-muted font-weight-bold mt-2 mb-2 mr-5">{{ $title }}</h5>
      <!--end::Page Title-->
      <!--begin::Actions-->
      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
      <!--begin::Breadcrumb-->
      <div class="d-flex align-items-center font-weight-bold my-2">
        <i class="flaticon2-shelter text-muted icon-1x opacity-75"></i>

        {{ $breadcrumb ?? ' ' }}

      </div>
      <!--end::Breadcrumb-->
      <!--end::Actions-->
    </div>

    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <!--begin::Actions-->
      {{ $slot }}
      <!--end::Actions-->
    </div>
    <!--end::Toolbar-->
  </div>
</div>
