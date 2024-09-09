@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Bidang">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('bidang.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('bidang.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('bidang.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Bidang</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">

              <x-validation.txt-stack type="text" id="b_name" name="b_name" placeholder="Nama Bidang"
                value="{{ old('b_name') }}" :messages="$errors->get('b_name')">Nama Bidang
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="text" id="b_kode" name="b_kode" placeholder="Kode Bidang"
                value="{{ old('b_kode') }}" :messages="$errors->get('b_kode')">Kode Bidang
                <x-redstar /></x-validation.txt-stack>

              <x-form.txtarea-stack name="b_desc" placeholder="Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('b_desc') }}
              </x-form.txtarea-stack>

            </div>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('bidang.index') }}" />

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
