@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Barang">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div>
      @can('barang multidelete')
        <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
          class="btn-sm btn-light-danger mx-1 btn-multdelete">
          Hapus Terpilih</x-btn.weight-bold-svg>
      @endcan

      @can('barang create')
        <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('barang.create') }}"
          class="btn-sm btn-light-success mx-1">
          Tambah Data</x-btn.a-weight-bold-svg>
      @endcan
      <x-btn.a-weight-bold-svg href="{{ route('barang.getbelanja') }}" svg="Media/Repeat.svg"
        class="btn-sm btn-light-warning mx-1">
        Atur Ulang Belanja</x-btn.a-weight-bold-svg>
    </div>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ route('barang.index') }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">

      <div class="row justify-content-center mb-4">
        <div class="col-lg-6">
          <div class="text-dark-50 line-height-lg">
            <div class="d-flex flex-column">

              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15 mb-5 text-dark">Jenis Belanja:</span>
                <div class="text-right"></div>
              </div>

              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">{{ $jenbel->jb_fullkode }}</span>
                <span class="text-right font-weight-light">{{ $jenbel->jb_name }}</span>
              </div>
              <div class="separator separator-dashed my-1"></div>

            </div>
          </div>
        </div>
      </div>
      <x-separator margin="3" />

      <form action="{{ route('barang.multdelete') }}" id="form-multdelete">
        <!--begin: Datatable-->
        <table class="table table-hover" id="Datatable">
          <thead>
            <tr>
              <th>
                <label class="checkbox checkbox-single">
                  <input type="checkbox" id="check-all" />
                  <span></span>
                </label>
              </th>
              <th>No</th>
              <th class="text-center">Kode Barang</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Keterangan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        <!--end: Datatable-->
      </form>
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->

  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/datatable/barang.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
