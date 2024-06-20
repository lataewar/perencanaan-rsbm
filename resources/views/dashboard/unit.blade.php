@extends('layouts.template')

@section('subheader')
  <x-subheader title="Dashboard">
  </x-subheader>
@endsection

@section('content')
  <!--begin::Row-->
  <div class="row">
    <div class="col-xl-12">
      <div class="row">
        <div class="col-xl-6">
          <div class="row">
            <div class="col-xl-6">
              <!--begin::Tiles Widget 12-->
              <div class="card card-custom gutter-b" style="height: 170px">
                <div class="card-body">
                  <span class="svg-icon svg-icon-4x svg-icon-danger">
                    {!! file_get_contents('assets/media/svg/icons/Home/Flower3.svg') !!}
                  </span>
                  <div class="text-dark font-weight-bolder font-size-h2 mt-3">
                    {{ formatNomor($unit) }}
                  </div>
                  <a href="{{ route('unit.index') }}"
                    class="text-muted text-hover-danger font-weight-bold font-size-lg mt-1">
                    Unit Kerja
                  </a>
                </div>
              </div>
              <!--end::Tiles Widget 12-->
            </div>
            <div class="col-xl-6">
              <!--begin::Tiles Widget 11-->
              <div class="card card-custom bg-primary gutter-b" style="height: 170px">
                <div class="card-body">
                  <span class="svg-icon svg-icon-4x svg-icon-white ml-n2">
                    {!! file_get_contents('assets/media/svg/icons/Communication/Outgoing-mail.svg') !!}
                  </span>
                  <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">
                    {{ formatNomor($dikirim) }}
                  </div>
                  <a href="{{ route('dashboard') }}" class="text-inverse-primary font-weight-bold font-size-lg mt-1">
                    Usulan Dikirim
                  </a>
                </div>
              </div>
              <!--end::Tiles Widget 11-->
            </div>
          </div>
          <div class="row">
            <div class="col-xl-6">
              <!--begin::Tiles Widget 13-->
              <div class="card card-custom bgi-no-repeat gutter-b"
                style="height: 175px; background-color: #663259; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url({{ asset('assets') }}/media/svg/patterns/aare.svg)">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center">
                  <div>
                    <h3 class="text-white font-weight-bolder line-height-lg mb-5">Atur Perencanaan</h3>
                    <a href="{{ route('perencanaan.index') }}" class="btn btn-primary font-weight-bold px-6 py-3">
                      Perencanaan
                    </a>
                  </div>
                </div>
                <!--end::Body-->
              </div>
              <!--end::Tiles Widget 13-->
            </div>
            <div class="col-xl-6">
              <!--begin::Tiles Widget 11-->
              <div class="card card-custom bg-success gutter-b card-stretch">
                <div class="card-body">
                  <span class="svg-icon svg-icon-4x svg-icon-white ml-n2">
                    {!! file_get_contents('assets/media/svg/icons/Communication/Readed-mail.svg') !!}
                  </span>
                  <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">
                    {{ formatNomor($disetujui) }}
                  </div>
                  <a href="{{ route('dashboard') }}" class="text-inverse-success font-weight-bold font-size-lg mt-1">
                    Usulan Diterima
                  </a>
                </div>
              </div>
              <!--end::Tiles Widget 11-->
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <!--begin::Mixed Widget 14-->
          <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b card-stretch"
            style="background-image: url({{ asset('assets') }}/media/stock-600x600/img-4.jpg)">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column align-items-start justify-content-start">
              <div class="p-1 flex-grow-1">
                <h3 class="text-white font-weight-boldest line-height-lg mb-2">Selamat Datang
                  "{{ auth()->user()->name }}",
                </h3>
                <h3 class="text-white font-weight-light line-height-lg mb-2">Di Aplikasi Sistem Monitoring Realisasi
                  Anggaran
                </h3>
                <h3 class="display-3 text-danger">SIMONREANGGAR</h3>
              </div>
            </div>
            <!--end::Body-->
          </div>
          <!--end::Mixed Widget 14-->
        </div>
      </div>
    </div>
  </div>
  <!--end::Row-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Vendors-->
@endpush
