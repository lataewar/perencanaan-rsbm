@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@php
  $parent_id = $parent->id ?? 0;
  $parent2_id = null;

  if ($parent) {
      $array = [];
      array_unshift($array, [
          'kode' => $parent->jb_fullkode,
          'name' => $parent->jb_name,
      ]);
      if ($parent->jenis_belanja) {
          $sub = $parent->jenis_belanja;
          $parent2_id = $sub->id;
          while ($sub) {
              array_unshift($array, [
                  'kode' => $sub->jb_fullkode,
                  'name' => $sub->jb_name,
              ]);
              $sub = $sub->jenis_belanja;
          }
      }
  }
@endphp

@section('subheader')
  <x-subheader title="Jenis Belanja">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">
      @can('jenis_belanja multidelete')
        <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
          class="btn-sm btn-light-danger mr-2 btn-multdelete">
          Hapus Terpilih</x-btn.weight-bold-svg>
      @endcan

      @can('jenis_belanja create')
        <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('jenbel.create', ['parent' => $parent_id]) }}"
          class="btn-sm btn-light-success btn-create">
          Tambah Data</x-btn.a-weight-bold-svg>
      @endcan
    </div>

    @if ($parent)
      <x-btn.a-weight-bold-svg href="{{ route('jenbel.index', ['parent' => $parent2_id]) }}"
        svg="Navigation/Angle-left.svg" class="btn-sm btn-light-primary ml-2">
        Kembali</x-btn.a-weight-bold-svg>
    @endif
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('jenbel/' . $parent_id) }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">

      @if ($parent)
        <div class="row justify-content-center mb-4">
          <div class="col-lg-6">
            <div class="text-dark-50 line-height-lg">
              <div class="d-flex flex-column">

                <div class="d-flex justify-content-between">
                  <span class="font-weight-bold mr-15 mb-5 text-dark">Jenis Belanja:</span>
                  <div class="text-right"></div>
                </div>

                @foreach ($array as $item)
                  <div class="d-flex justify-content-between">
                    <span class="font-weight-bold mr-15">{{ $item['kode'] }}</span>
                    <span class="text-right font-weight-light">{{ $item['name'] }}</span>
                  </div>
                  <div class="separator separator-dashed my-1"></div>
                @endforeach

              </div>
            </div>
          </div>
        </div>
        <x-separator margin="5" />
      @endif

      <form action="{{ route('jenbel.multdelete', ['parent' => $parent_id]) }}" id="form-multdelete">
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
              <th>Kode</th>
              <th>Jenis Belanja</th>
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
  <script src="{{ asset('js') }}/datatable/jenbel.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
