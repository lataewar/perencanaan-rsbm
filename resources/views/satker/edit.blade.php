@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Satuan Kerja">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('satker.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Ubah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('satker.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('satker.update', ['satker' => $data->id]) }}" class="row" method="POST">
    @csrf
    @method('PUT')
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah Satuan Kerja</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">

              <x-validation.txt-stack type="text" id="sk_name" name="sk_name" placeholder="Nama Satuan Kerja"
                value="{{ old('sk_name') ?? $data->sk_name }}" :messages="$errors->get('sk_name')">Nama Satuan Kerja
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="text" id="sk_kode" name="sk_kode" placeholder="Kode Satuan Kerja"
                value="{{ old('sk_kode') ?? $data->sk_kode }}" :messages="$errors->get('sk_kode')">Kode Satuan Kerja
                <x-redstar /></x-validation.txt-stack>

              <x-form.txtarea-stack name="sk_desc" placeholder="Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('sk_desc') ?? $data->sk_desc }}
              </x-form.txtarea-stack>

            </div>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('satker.index') }}" />

      </div>
    </div>
  </form>
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
