@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Buat Perbelanjaan dari Usulan">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('belanja.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('belanja.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="jenbel_url" value="{{ route('selector.jenbel') }}">
  <input type="hidden" id="barang_url" value="{{ route('selector.barang') }}">
  <form action="{{ route('belanja.store.usulan') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Belanja Berdasarkan Usulan</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-center my-5 px-10">
            <div class="col-xl-12 col-xxl-9">

              <h3 class="mb-10 font-weight-bold text-dark">Isi Data</h3>

              <input type="hidden" name="usulan_id" value="{{ $usulan->id }}">

              <x-validation.inline.txt type="text" value="{{ $usulan->ul_name }}" disabled>Nama Usulan Barang
              </x-validation.inline.txt>

              <x-validation.inline.select-kdnm name="jenbel_1" id="selector1" :messages="$errors->get('jenbel_1')" :options="$jenbels"
                :current="old('jenbel_1')">
                Jenis Belanja<x-redstar />
              </x-validation.inline.select-kdnm>

              <x-validation.inline.select-kdnm name="jenbel_2" id="selector2" :messages="$errors->get('jenbel_2')" :current="old('jenbel_2')">
                Jenis Belanja<x-redstar />
              </x-validation.inline.select-kdnm>

              <x-validation.inline.select-kdnm name="jenis_belanja_id" id="selector3" :messages="$errors->get('jenis_belanja_id')" :current="old('jenis_belanja_id')">
                Jenis Belanja<x-redstar />
              </x-validation.inline.select-kdnm>

              <x-validation.inline.select-kdnm name="barang_id" id="selector4" :messages="$errors->get('barang_id')" :current="old('barang_id')">
                Nama Barang<x-redstar />
              </x-validation.inline.select-kdnm>

              <x-validation.inline.txt type="text" name="jumlah" placeholder="Jumlah Barang"
                value="{{ old('jumlah') ?? formatNomor($usulan->ul_qty) }}" oninput="formatRupiah(this, '.')"
                :messages="$errors->get('jumlah')">Jumlah
                Barang<x-redstar />
              </x-validation.inline.txt>

              <x-validation.inline.txt type="text" name="harga" placeholder="Harga Barang"
                value="{{ old('harga') ?? formatNomor($usulan->ul_prise) }}" oninput="formatRupiah(this, '.')"
                :messages="$errors->get('harga')">Harga
                Barang
              </x-validation.inline.txt>

              <x-validation.inline.txtarea name="desc" placeholder="Spesifikasi/Keterangan">
                @slot('title')
                  Keterangan
                @endslot
                {{ old('desc') ?? $usulan->ul_desc }}
              </x-validation.inline.txtarea>

              <x-validation.inline.select-static name="sumber_anggaran" :current="old('sumber_anggaran')" :options="\App\Enums\SumberAnggaranEnum::toArray()">
                Sumber Anggaran
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
      $("#selector4").select2({
        placeholder: "Pilih salah satu..."
      });
    });
  </script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/select/select4.js"></script>
  <!--end::Page Scripts-->
@endpush
