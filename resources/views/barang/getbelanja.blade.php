@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Pilih Jenis Belanja">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('barang.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Jenis Belanja</x-bc.item>
    </x-slot>

  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="jenbel_url" value="{{ route('selector.jenbel') }}">
  <form action="{{ route('barang.setbelanja') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Pilih Jenis Belanja</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-center my-5 px-10">
            <div class="col-xl-12 col-xxl-9">

              <h3 class="mb-10 font-weight-bold text-dark">Isi Data</h3>

              <x-validation.inline.select-kdnm name="jenisbelanjaid1" id="selector1" :messages="$errors->get('jenisbelanjaid1')" :options="$jenbels"
                :current="old('jenisbelanjaid1')">
                Jenis Belanja<x-redstar />
              </x-validation.inline.select-kdnm>

              <x-validation.inline.select-kdnm name="jenisbelanjaid2" id="selector2" :messages="$errors->get('jenisbelanjaid2')" :current="old('jenisbelanjaid2')">
                Jenis Belanja<x-redstar />
              </x-validation.inline.select-kdnm>

              <x-validation.inline.select-kdnm name="jenisbelanjaid3" id="selector3" :messages="$errors->get('jenisbelanjaid3')" :current="old('jenisbelanjaid3')">
                Jenis Belanja<x-redstar />
              </x-validation.inline.select-kdnm>

              <x-validation.inline.submit :route="route('belanja.index')" />

            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script>
    $(document).ready(function() {
      selector();
      $("#selector1").select2({
        placeholder: "Pilih salah satu..."
      });
      $("#selector2").select2({
        placeholder: "Pilih salah satu..."
      });
      $("#selector3").select2({
        placeholder: "Pilih salah satu..."
      });
    });
  </script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/select/select3.js"></script>
  <!--end::Page Scripts-->
@endpush
