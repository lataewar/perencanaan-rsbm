@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Unit Kerja">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('unit.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('unit.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('unit.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Unit Kerja</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">

              <x-validation.txt-stack type="text" id="u_name" name="u_name" placeholder="Nama Unit Kerja"
                value="{{ old('u_name') }}" :messages="$errors->get('u_name')">Nama Unit Kerja
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="text" id="u_kode" name="u_kode" placeholder="Kode Unit Kerja"
                value="{{ old('u_kode') }}" :messages="$errors->get('u_kode')">Kode Unit Kerja
                <x-redstar /></x-validation.txt-stack>

              <x-form.txtarea-stack name="u_desc" placeholder="Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('u_desc') }}
              </x-form.txtarea-stack>

            </div>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('unit.index') }}" />

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
