@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Menu">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">
      @can('menu multidelete')
        <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
          class="btn-sm btn-light-danger mr-2 btn-multdelete">
          Hapus Terpilih</x-btn.weight-bold-svg>
      @endcan

      @can('menu create')
        <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('menu.create') }}"
          class="btn-sm btn-light-success btn-create">
          Tambah Data</x-btn.a-weight-bold-svg>
      @endcan
    </div>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('menu') }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">
      <!--begin: Datatable-->
      <table class="table table-hover" id="Datatable">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Route</th>
            <th>Icon</th>
            <th>Has SubMenu</th>
            <th>Keterangan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <!--end: Datatable-->
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/datatable/menu.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
