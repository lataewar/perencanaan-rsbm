@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Tambah Barang">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('detailbelanja.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('detailbelanja.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('detailbelanja.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Barang</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-9">
              <!--begin::Wizard Data-->
              <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                <h3 class="mb-10 font-weight-bold text-dark">Isi Data</h3>
                <!--begin::Input-->

                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">
                    Barang<x-redstar />
                  </label>
                  <div class="col-lg-9 col-xl-9">
                    <select class="form-control form-control-lg" name="barang_id" id="selector1">
                      <option value="" hidden>- Pilih Salah Satu -</option>
                      @foreach ($barangs as $item)
                        @if (old('barang_id') == $item->id)
                          <option value="{{ $item->id }}" selected>{{ $item->fullkode . ' - ' . $item->name }}
                          </option>
                        @else
                          <option value="{{ $item->id }}">{{ $item->fullkode . ' - ' . $item->name }}</option>
                        @endif
                      @endforeach
                    </select>
                    <x-validation.input-error :messages="$errors->get('barang_id')" />
                  </div>
                </div>

                <x-validation.inline.txt type="text" name="harga" placeholder="Harga Barang"
                  value="{{ old('harga') }}" :messages="$errors->get('harga')">Harga Barang<x-redstar />
                </x-validation.inline.txt>

                <x-validation.inline.txt type="number" name="jumlah" placeholder="Jumlah Barang"
                  value="{{ old('jumlah') }}" :messages="$errors->get('jumlah')">Jumlah Barang<x-redstar />
                </x-validation.inline.txt>

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
