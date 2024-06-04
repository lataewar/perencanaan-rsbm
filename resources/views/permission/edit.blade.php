@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Permission">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('permission.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Ubah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('permission.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <div class="card card-custom gutter-b">
    <div class="card-body">
      <form action="{{ route('permission.update', ['permission' => $data->id]) }}" class="row" method="POST">
        @csrf
        @method('PUT')
        <div class="col-md-12">
          <div class="card card-custom card-stretch gutter-b">
            <div class="card-header">
              <h3 class="card-title">Ubah Permission</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 bgi-no-repeat"
                  style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
                </div>
                <div class="col-md-6">

                  <input type="hidden" name="r_type" value="edit">
                  <input type="hidden" name="id" value="{{ $data->id }}">

                  <x-validation.txt-stack type="text" id="name" name="name" placeholder="Nama Persmission"
                    value="{{ old('name') ?? $data->name }}" :messages="$errors->get('name')">Nama Persmission
                    <x-redstar /></x-validation.txt-stack>

                </div>
              </div>
            </div>

            <x-form.submit-group-card route="{{ route('permission.index') }}" />

          </div>
        </div>
      </form>
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
