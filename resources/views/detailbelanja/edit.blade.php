@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Detal Barang Belanja">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('detailbelanja.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Ubah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('detailbelanja.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('detailbelanja.update', ['barang' => $data->id, 'belanja' => $data->pivot->belanja_id]) }}"
    method="POST">
    @csrf @method('PUT')
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah Barang Belanja</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-9">
              <!--begin::Wizard Data-->
              <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                <h3 class="mb-10 font-weight-bold text-dark">Isi Data</h3>
                <!--begin::Input-->

                <x-validation.inline.txt type="text" value="{{ $data->br_name }}" :messages="[]" disabled>Barang
                </x-validation.inline.txt>

                <x-validation.inline.txt type="text" name="harga" placeholder="Harga Barang"
                  value="{{ old('harga') ?? formatNomor($data->pivot->harga) }}" oninput="formatRupiah(this, '.')"
                  :messages="$errors->get('harga')">Harga Barang<x-redstar />
                </x-validation.inline.txt>

                <x-validation.inline.txt type="text" name="jumlah" placeholder="Jumlah Barang"
                  value="{{ old('jumlah') ?? formatNomor($data->pivot->jumlah) }}" oninput="formatRupiah(this, '.')"
                  :messages="$errors->get('jumlah')">Jumlah Barang<x-redstar />
                </x-validation.inline.txt>

                <x-validation.inline.txtarea name="desc" placeholder="Spesifikasi" :messages="$errors->get('desc')">
                  @slot('title')
                    Spesifikasi
                  @endslot
                  {{ old('desc') ?? $data->pivot->desc }}
                </x-validation.inline.txtarea>

              </div>
              <!--end::Wizard Data-->

              <!--begin::Wizard Actions-->
              <div class="d-flex justify-content-between border-top mt-5 pt-10">
                <div class="mr-2"> </div>
                <div>
                  <a href="{{ route('detailbelanja.index') }}"
                    class="btn btn-danger font-weight-bolder text-uppercase px-9 py-4">Batal</a>
                  <button type="submit"
                    class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">Simpan</button>
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
