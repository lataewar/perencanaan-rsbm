@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Tambah Barang">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('usul.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('usul.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('usul.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Barang</h3>
        </div>
        <div class="card-body">
          <div class="px-8 my-10 row justify-content-center my-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-9">
              <!--begin::Wizard Data-->
              <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                <h3 class="mb-10 font-weight-bold text-dark">Isi Data</h3>
                <!--begin::Input-->

                <x-validation.inline.txt type="text" name="ul_name" placeholder="Nama Barang"
                  value="{{ old('ul_name') }}" :messages="$errors->get('ul_name')">Nama
                  Barang<x-redstar />
                </x-validation.inline.txt>

                <x-validation.inline.txt type="text" name="ul_qty" placeholder="Jumlah Barang"
                  value="{{ old('ul_qty') }}" oninput="formatRupiah(this, '.')" :messages="$errors->get('ul_qty')">Jumlah
                  Barang<x-redstar />
                </x-validation.inline.txt>

                <x-validation.inline.txt type="text" name="ul_prise" placeholder="Harga Barang"
                  value="{{ old('ul_prise') }}" oninput="formatRupiah(this, '.')" :messages="$errors->get('ul_prise')">Harga
                  Barang
                </x-validation.inline.txt>

                <x-validation.inline.txtarea name="ul_desc" placeholder="Spesifikasi/Keterangan" :messages="$errors->get('ul_desc')">
                  @slot('title')
                    Spesifikasi
                  @endslot
                  {{ old('ul_desc') }}
                </x-validation.inline.txtarea>

                @if (count($ruangans) > 0)
                  <x-validation.inline.select-static name="ruangan_id" :current="old('ruangan_id')"
                    :options="$ruangans" :messages="$errors->get('ruangan_id')">
                    Ruangan<x-redstar />
                  </x-validation.inline.select-static>
                @endif

              </div>
              <!--end::Wizard Data-->

              <!--begin::Wizard Actions-->
              <div class="pt-10 mt-5 d-flex justify-content-between border-top">
                <div class="mr-2"> </div>
                <div>
                  <a href="{{ route('usul.index') }}"
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
