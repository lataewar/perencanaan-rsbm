@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Barang">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('barang.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('barang.index', ['id' => $id]) }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('barang.store', ['id' => $id]) }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Barang</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">
              @include('layouts.validation-error')

              <input type="hidden" name="jenis_belanja_id" value="{{ $id }}">

              <x-validation.txt-stack type="text" id="br_kode" name="br_kode" placeholder="Kode Barang"
                value="{{ old('br_kode') }}" :messages="$errors->get('br_kode')">Kode Barang
              </x-validation.txt-stack>

              <x-validation.txt-stack type="text" id="br_name" name="br_name" placeholder="Nama Barang"
                value="{{ old('br_name') }}" :messages="$errors->get('br_name')">Nama Barang
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="text" id="br_satuan" name="br_satuan" placeholder="Satuan"
                value="{{ old('br_satuan') }}" :messages="$errors->get('br_satuan')">Satuan
                <x-redstar /></x-validation.txt-stack>

              <x-form.txtarea-stack name="br_desc" placeholder="Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('br_desc') }}
              </x-form.txtarea-stack>

            </div>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('barang.index') }}" />

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
