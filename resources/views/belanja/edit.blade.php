@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Ubah Perbelanjaan">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('belanja.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Ubah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('belanja.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form
    action="{{ route('belanja.update', ['barang' => $data->pivot->barang_id, 'belanja' => $data->pivot->belanja_id]) }}"
    class="row" method="POST">@method('PUT')
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah Belanja</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-9">
              <!--begin::Wizard Data-->
              <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                <h3 class="mb-10 font-weight-bold text-dark">Isi Data</h3>
                <!--begin::Input-->

                <x-validation.inline.txt type="text" value="{{ $data->br_name }}" disabled>Nama Usulan Barang
                </x-validation.inline.txt>

                <x-validation.inline.txt type="text" name="jumlah" placeholder="Jumlah Barang"
                  value="{{ old('jumlah') ?? formatNomor($data->pivot->jumlah) }}" oninput="formatRupiah(this, '.')"
                  :messages="$errors->get('jumlah')">Jumlah
                  Barang<x-redstar />
                </x-validation.inline.txt>

                <x-validation.inline.txt type="text" name="harga" placeholder="Harga Barang"
                  value="{{ old('harga') ?? formatNomor($data->pivot->harga) }}" oninput="formatRupiah(this, '.')"
                  :messages="$errors->get('harga')">Harga
                  Barang
                </x-validation.inline.txt>

                <x-validation.inline.txtarea name="desc" placeholder="Spesifikasi/Keterangan">
                  @slot('title')
                    Keterangan
                  @endslot
                  {{ old('desc') ?? $data->pivot->desc }}
                </x-validation.inline.txtarea>

                <x-validation.inline.select-static name="sumber_anggaran" :current="old('sumber_anggaran') ?? $data->pivot->sumber_anggaran" :options="\App\Enums\SumberAnggaranEnum::toArray()">
                  Sumber Anggaran
                </x-validation.inline.select-static>

                <x-validation.inline.select-static name="skala_prioritas" :current="old('skala_prioritas') ?? $data->pivot->skala_prioritas" :options="\App\Enums\PrioritasEnum::toArray()">
                  Prioritas
                </x-validation.inline.select-static>

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
      $("#selector1").select2({
        placeholder: "Pilih salah satu..."
      });
    });
  </script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
