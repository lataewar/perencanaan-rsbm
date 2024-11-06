@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@php
  $isCanUpdateBelanja = auth()
      ->user()
      ->can('update', App\Models\Usulan::class);
  $isPeriodeAktif = auth()
      ->user()
      ->can('is_periode_aktif', $data);
  $status = $data->statuses->last()->status;
@endphp
@section('subheader')
  <x-subheader title="Detail Usulan">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div>
      @can('perencanaan delete')
        @if ($isCanUpdateBelanja)
          <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
            class="mr-2 btn-sm btn-light-danger btn-multdelete">
            Hapus Terpilih</x-btn.weight-bold-svg>
        @endif
      @endcan

      @can('perencanaan update')
        @if ($isCanUpdateBelanja)
          <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('usul.create') }}"
            class="btn-sm btn-light-success btn-create">
            Tambah Data</x-btn.a-weight-bold-svg>
        @endif
      @endcan
    </div>
    <x-btn.a-weight-bold-svg href="{{ route('usulan.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  @can('perencanaan send')
    <input type="hidden" id="urx_send" value="{{ route('usulan.send') }}">
  @endcan
  <input type="hidden" id="urx" value="{{ route('usul.index') }}">
  <div class="card card-custom gutter-b">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon">
          <i class="flaticon2-website text-primary"></i>
        </span>
        <h3 class="card-label">
          Detail Usulan
        </h3>
      </div>
      <div class="card-toolbar">
        <div>
          <x-table.menu-dropdown>

            @if (auth()->user()->can('perencanaan send') && ($status->isDraft() || $status->isDitolak()) && $data->usulans_count > 0 && $isPeriodeAktif)
              <x-table.nav-item route="javascript:;" name="Kirim" icon="la la-send" :item="$data" />
              <x-table.nav-separator />
            @endif

            @if ($data->usulans_count > 0)
              <x-table.nav-item :route="route('usulan.cetak', $data->id)" name="Cetak Excell" icon="la la-print" />
            @endif

          </x-table.menu-dropdown>
        </div>
      </div>
    </div>
    <div class="card-body">

      <div class="mb-4 row justify-content-center">
        <div class="col-lg-6">
          <div class="text-dark-50 line-height-lg">
            <div class="d-flex flex-column">

              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Unit:</span>
                <span class="text-right font-weight-light">{{ $data->unit->u_name }}</span>
              </div>
              <x-separator margin="1" />
              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Tahun/Periode:</span>
                <span class="text-right font-weight-light">{{ $data->p_tahun . ' / ' . $data->p_periode }}</span>
              </div>
              <x-separator margin="1" />
              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Status Usulan:</span>
                <button type="button" style="margin: 0; padding: 0; border: 0; background-color: transparent;"
                  class="btn btn-primary" data-toggle="popover" data-trigger="click" data-placement="bottom"
                  title="Riwayat Status" data-html="true"
                  data-content="
                    @foreach ($data->statuses->reverse() as $item)
                    <x-status-list
                    :data="$item" /> @endforeach
                  ">
                  {!! $status->getLabelHTML() !!}
                </button>
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
              <th>Ruangan</th>
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
  <script src="{{ asset('js') }}/table/table.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
