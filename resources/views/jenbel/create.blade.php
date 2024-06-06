@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@php $parent_id = $parent->id ?? 0; @endphp

@section('subheader')
  <x-subheader title="Jenis Belanja">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('jenbel.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('jenbel.index', ['parent' => $parent_id]) }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('jenbel.store', ['parent' => $parent_id]) }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Jenis Belanja</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">

              <input type="hidden" name="jb_level" value="{{ ($parent->jb_level ?? 0) + 1 }}">
              <input type="hidden" name="parent_fullkode" value="{{ $parent->jb_fullkode ?? 0 }}">

              <x-validation.txt-stack type="text" id="jb_kode" name="jb_kode" placeholder="Kode Rekening"
                value="{{ old('jb_kode') }}" :messages="$errors->get('jb_kode')">Kode Rekening
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="text" id="jb_name" name="jb_name" placeholder="Nama Jenis Belanja"
                value="{{ old('jb_name') }}" :messages="$errors->get('jb_name')">Nama Jenis Belanja
                <x-redstar /></x-validation.txt-stack>

            </div>
            <div class="col-md-6">
              <x-form.txtarea-stack name="jb_desc" placeholder="Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('jb_desc') }}
              </x-form.txtarea-stack>
            </div>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('jenbel.index', ['parent' => $parent_id]) }}" />

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
