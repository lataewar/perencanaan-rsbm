@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Sub Menu - {{ $data->name }}">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('submenu.index', ['menu' => $data->id]) }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('submenu.index', ['menu' => $data->id]) }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('submenu.store', ['menu' => $data->id]) }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Sub Menu</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="menu_id" value="{{ $data->id }}">
              <x-validation.txt-stack type="text" id="name" name="name" placeholder="Nama Sub Menu"
                value="{{ old('name') }}" :messages="$errors->get('name')">Nama Sub Menu
                <x-redstar /></x-validation.txt-stack>

              <x-form.txt-stack name="route" value="{{ old('route') }}">Route </x-form.txt-stack>
            </div>
            <div class="col-md-6">
              <x-form.txt-stack name="icon" value="{{ old('icon') }}">Icon </x-form.txt-stack>
              <x-form.txtarea-stack name="desc" placeholder="Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('desc') }}
              </x-form.txtarea-stack>
            </div>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('submenu.index', ['menu' => $data->id]) }}" />

      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->

  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
