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
      <x-bc.item route="#">Ubah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('jenbel.index', ['parent' => $parent_id]) }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.validation-error')
  <!--begin::Card-->
  <form action="{{ route('jenbel.update', ['jenbel' => $data->id, 'parent' => $parent_id]) }}" class="row"
    method="POST">
    @csrf
    @method('PUT')
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah jenbel</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">

              <x-validation.txt-stack type="text" id="jb_name" name="jb_name" placeholder="Nama Jenis Belanja"
                value="{{ old('jb_name') ?? $data->jb_name }}" :messages="$errors->get('jb_name')">Nama Jenis Belanja
                <x-redstar /></x-validation.txt-stack>

            </div>
            <div class="col-md-6">
              <x-form.txtarea-stack name="jb_desc" placeholder="Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('jb_desc') ?? $data->jb_desc }}
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
