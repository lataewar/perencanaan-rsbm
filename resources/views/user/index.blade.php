@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="User">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">
      @can('user multidelete')
        <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
          class="btn-sm btn-light-danger mr-2 btn-multdelete">
          Hapus Terpilih</x-btn.weight-bold-svg>
      @endcan

      @can('user create')
        <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('user.create') }}"
          class="btn-sm btn-light-success btn-create">
          Tambah Data</x-btn.a-weight-bold-svg>
      @endcan
    </div>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ route('user.index') }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">
      <form action="{{ route('user.multdelete') }}" id="form-multdelete">
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
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Dibuat Pada</th>
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
  <script src="{{ asset('js') }}/datatable/user.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
