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
      <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
        class="btn-sm btn-light-danger mr-2 btn-multdelete">
        Hapus Terpilih</x-btn.weight-bold-svg>

      <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('barang.create', ['id' => $id ?? 0]) }}"
        class="btn-sm btn-light-success btn-create" style="display: none;">
        Tambah Data</x-btn.a-weight-bold-svg>
    </div>
    <x-btn.weight-bold-svg svg="Navigation/Angle-left.svg" style="display: none;" class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('barang/' . $id) }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">

      <div class="col-lg-12">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="form-group">
              <label>Jenis Belanja</label>
              <select class="form-control" id="selector1">
                <option value="" hidden>Pilih Jenis Belanja...</option>
                @foreach ($jenbel as $item)
                  @if ($id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->jb_fullkode . ' - ' . $item->jb_name }}
                    </option>
                  @else
                    <option value="{{ $item->id }}">{{ $item->jb_fullkode . ' - ' . $item->jb_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>&nbsp;
              </label>
              <button onclick="getSelected('{{ URL('barang') }}')" class="btn btn-primary d-flex flex-nowrap">
                <i class="la la-refresh"></i>Proses
              </button>
            </div>
          </div>
        </div>
      </div>

      <x-separator margin="3" />

      <form action="{{ route('barang.multdelete', ['id' => $id ?? 0]) }}" id="form-multdelete">
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
  <script>
    const getSelected = function(routeX) {
      const selector = $("#selector1").val();
      if (selector) {
        location.href = routeX + "/" + selector;
      }
    };

    $(document).ready(function() {
      $("#selector1").select2({
        placeholder: "Pilih salah satu..."
      });
      if ($("#selector1").val()) {
        $(".btn-create").show();
      }
    });
  </script>
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/datatable/barang.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
