@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Role">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('role.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
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
      <form action="{{ route('role.store') }}" class="row" method="POST">
        @csrf
        <div class="col-md-12">
          <div class="card card-custom card-stretch gutter-b">
            <div class="card-header">
              <h3 class="card-title">Tambah Role</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <x-validation.txt-stack type="text" id="name" name="name" placeholder="Nama Role"
                    value="{{ old('name') }}" :messages="$errors->get('name')">Nama Role
                    <x-redstar /></x-validation.txt-stack>
                </div>
                <div class="col-md-6">
                  <x-form.txtarea-stack name="desc" placeholder="Keterangan">
                    @slot('title')
                      Keterangan
                    @endslot
                    {{ old('desc') }}
                  </x-form.txtarea-stack>
                </div>
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
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
