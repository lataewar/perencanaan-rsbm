@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Detail Usulan">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div>
      @can('perencanaan delete')
        @can('update', App\Models\Usulan::class)
          <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
            class="btn-sm btn-light-danger mr-2 btn-multdelete">
            Hapus Terpilih</x-btn.weight-bold-svg>
        @endcan
      @endcan

      @can('perencanaan update')
        @can('update', App\Models\Usulan::class)
          <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('usul.create') }}"
            class="btn-sm btn-light-success btn-create">
            Tambah Data</x-btn.a-weight-bold-svg>
        @endcan
      @endcan
    </div>
    <x-btn.a-weight-bold-svg href="{{ route('usulan.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ route('usul.index') }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">

      <div class="row justify-content-center mb-4">
        <div class="col-lg-6">
          <div class="text-dark-50 line-height-lg">
            <div class="d-flex flex-column">

              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Unit:</span>
                <span class="text-right font-weight-light">{{ $data->u_name }}</span>
              </div>
              <x-separator margin="1" />
              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Tahun/Periode:</span>
                <span class="text-right font-weight-light">{{ $data->p_tahun . ' / ' . $data->p_periode }}</span>
              </div>
              <x-separator margin="1" />
              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Status Usulan:</span>
                <span class="text-right font-weight-light">{!! App\Enums\StatusEnum::from($data->status)->getLabelHTML() !!}</span>
              </div>
              <x-separator margin="2" />

            </div>
          </div>
        </div>
      </div>
      <x-separator margin="5" />

      <form action="{{ route('usul.multdelete') }}" id="form-multdelete">
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
              <th>Nama Barang</th>
              <th class="text-right">Harga</th>
              <th class="text-right">Jumlah</th>
              <th class="text-right">Total</th>
              <th>Spesifikasi</th>
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
  <script src="{{ asset('js') }}/datatable/usul.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
