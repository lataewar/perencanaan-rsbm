@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Role">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('role.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Role Akses</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('role.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('permission.sync', ['role' => $app->id]) }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Perizinan</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Beri Izin ke aksi</label>
            <select class="form-control select2" name="permissions[]" multiple="multiple">
              @foreach ($app->permissions as $permission)
                <option value="{{ $permission }}"
                  @foreach ($app->data as $item)
                      @if ($item == $permission)
                        selected
                      @endif @endforeach>
                  {{ $permission }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('role.index') }}" />

      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // multi select
      $('.select2').select2({
        placeholder: 'Select a state',
      });
    });
  </script>
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
