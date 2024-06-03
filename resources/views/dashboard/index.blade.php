@extends('layouts.template')

@section('subheader')
  <x-subheader title="Dashboard">
  </x-subheader>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-9">
          <!--begin::Card-->
          <div class="card card-custom gutter-b card-stretch">
            <div class="card-header">
              <div class="card-title">
                <h3 class="card-label">Panel</h3>
              </div>
            </div>
            <div class="card-body">
              <!--begin::Chart-->
              <div id="column_chart"></div>
              <!--end::Chart-->
            </div>
          </div>
          <!--end::Card-->
        </div>
        <div class="col-lg-3">
          <div class="row">
            <div class="col-lg-12">
              <!--begin::Tiles Widget 12-->
              <div class="card card-custom gutter-b" style="height: 150px">
                <div class="card-body">
                  <span class="svg-icon svg-icon-3x svg-icon-success">
                    {!! file_get_contents('assets/media/svg/icons/Home/Flower3.svg') !!}
                  </span>
                  <div class="text-dark font-weight-bolder font-size-h2 mt-3">200
                  </div>
                  <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Item</a>
                </div>
              </div>
              <!--end::Tiles Widget 12-->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!--begin::Tiles Widget 11-->
              <div class="card card-custom bg-primary gutter-b" style="height: 150px">
                <div class="card-body">
                  <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                    {!! file_get_contents('assets/media/svg/icons/General/Attachment2.svg') !!}
                  </span>
                  <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">
                    300
                  </div>
                  <a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1">Daftar Item</a>
                </div>
              </div>
              <!--end::Tiles Widget 11-->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!--begin::Tiles Widget 13-->
              <div class="card card-custom bgi-no-repeat gutter-b"
                style="height: 175px; background-color: #663259; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url({{ asset('assets') }}/media/svg/patterns/taieri.svg)">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center">
                  <div>
                    <h3 class="text-white font-weight-bolder line-height-lg mb-5">
                      Detail Item
                    </h3>
                    <a href='#' class="btn btn-success font-weight-bold px-6 py-3">Detail</a>
                  </div>
                </div>
                <!--end::Body-->
              </div>
              <!--end::Tiles Widget 13-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Vendors-->
@endpush
