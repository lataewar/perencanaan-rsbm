@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Role - {{ $app->data->name }}">
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
  <div class="card card-custom gutter-b">
    <div class="card-body">
      <form action="{{ route('akses.sync', ['role' => $app->data->id]) }}" class="row" method="POST">
        @csrf
        <div class="col-md-12">
          <div class="card card-custom card-stretch gutter-b">
            <div class="card-header">
              <h3 class="card-title">Akses Ke Menu</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Akses Ke Menu</label>
                <select class="form-control select2" name="menus[]" multiple="multiple">
                  @foreach ($app->menus as $menu)
                    <option value="{{ $menu->id }}"
                      @foreach ($app->data->menus as $item)
                      @if ($item->id == $menu->id)
                        selected
                      @endif @endforeach>
                      {{ $menu->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <x-form.submit-group-card route="{{ route('role.index') }}" />

          </div>
        </div>
      </form>
    </div>
  </div>
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
