@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Detail Belanja">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div>
      <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
        class="btn-sm btn-light-danger mr-2 btn-multdelete">
        Hapus Terpilih</x-btn.weight-bold-svg>

      <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('detailbelanja.create') }}"
        class="btn-sm btn-light-success btn-create">
        Tambah Data</x-btn.a-weight-bold-svg>
    </div>
    <x-btn.a-weight-bold-svg href="{{ route('belanja.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('perencanaan/detailbelanja/') }}">
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
                <span class="font-weight-bold mr-15">{{ $data->jb1_fullkode }}</span>
                <span class="text-right font-weight-light">{{ $data->jb1_name }}</span>
              </div>
              <div class="separator separator-dashed my-1"></div>

              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">{{ $data->jb2_fullkode }}</span>
                <span class="text-right font-weight-light">{{ $data->jb2_name }}</span>
              </div>
              <div class="separator separator-dashed my-1"></div>

              <div class="d-flex justify-content-between">
                <span class="font-weight-boldest mr-15">{{ $data->jb3_fullkode }}</span>
                <span class="text-right font-weight-boldest">{{ $data->jb3_name }}</span>
              </div>
              <div class="separator separator-dashed my-3"></div>

              <div class="d-flex justify-content-between text-primary">
                <span class="font-weight-boldest mr-15">Total Barang</span>
                <span class="text-right font-weight-boldest">{{ formatNomor($data->total_jumlah) }}</span>
              </div>
              <div class="separator separator-dashed my-1"></div>
              <div class="d-flex justify-content-between text-primary">
                <span class="font-weight-boldest mr-15">Total Belanja</span>
                <span class="text-right font-weight-boldest">{{ formatNomor($data->total_harga) }}</span>
              </div>
              <div class="separator separator-dashed my-1"></div>

            </div>
          </div>
        </div>
      </div>
      <x-separator margin="3" />

      <form action="{{ route('detailbelanja.multdelete') }}" id="form-multdelete">
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
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th class="text-right">Harga</th>
              <th class="text-right">Jumlah</th>
              <th class="text-right">Total</th>
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
  <script src="{{ asset('js') }}/datatable/detailbelanja.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush