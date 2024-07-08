@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Alat Kesehatan">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ route('alkes.index') }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">

      <!--begin: Datatable-->
      <table class="table table-hover" id="Datatable">
        <thead>
          <tr>
            <th>Mark</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Ada</th>
            <th>No Seri</th>
            <th>Merk</th>
            <th>Type</th>
            <th>Thn Pengadaan</th>
            <th>Thn Operasional</th>
            <th>Berfungsi</th>
            <th>Kalibrasi</th>
            <th>Harga</th>
            <th>Pendanaan</th>
            <th>Distributor</th>
            <th>AKL/AKD</th>
            <th>Keterangan</th>
            <th>*</th>
            <th>**</th>
            <th>***</th>
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
  <script src="{{ asset('js') }}/datatable/alkes.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
