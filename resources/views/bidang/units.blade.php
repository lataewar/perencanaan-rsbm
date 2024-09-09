@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Bidang - {{ $app->data->b_name }}">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('bidang.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Unit</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('bidang.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('bidang.sync', ['bidang' => $app->data->id]) }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Akses Ke Unit</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Akses Ke Unit</label>
            <select class="form-control select2" name="units[]" multiple="multiple">
              @foreach ($app->units as $unit)
                <option value="{{ $unit->id }}"
                  @foreach ($app->data->units as $item)
                      @if ($item->id == $unit->id)
                        selected
                      @endif @endforeach>
                  {{ $unit->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('bidang.index') }}" />

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
