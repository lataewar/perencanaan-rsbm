@extends('layouts.template')

@push('css')
@endpush

@section('subheader')
  <x-subheader title="Buat Usulan">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('usulan.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('usulan.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('usulan.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Usulan</h3>
        </div>
        <div class="card-body">
          <div class="px-8 my-10 row justify-content-center my-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-9">
              <!--begin::Wizard Data-->
              <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                <h3 class="mb-10 font-weight-bold text-dark">Isi Data</h3>
                <!--begin::Input-->

                <x-validation.inline.select-static name="p_tahun" :messages="$errors->get('p_tahun')" :options="$tahuns">
                  Tahun<x-redstar />
                </x-validation.inline.select-static>
                <!--end::Group-->
              </div>
              <!--end::Wizard Data-->

              <!--begin::Wizard Actions-->
              <div class="pt-10 mt-5 d-flex justify-content-between border-top">
                <div class="mr-2"> </div>
                <div>
                  <a href="{{ route('usulan.index') }}"
                    class="py-4 btn btn-danger font-weight-bolder text-uppercase px-9">Batal</a>
                  <button type="submit"
                    class="py-4 btn btn-primary font-weight-bolder text-uppercase px-9">Simpan</button>
                </div>
              </div>
              <!--end::Wizard Actions-->
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

  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
