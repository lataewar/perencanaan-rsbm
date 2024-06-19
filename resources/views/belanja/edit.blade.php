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
  <form action="{{ route('belanja.update', $data->id) }}" class="row" method="POST">@method('PUT')
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

                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">
                    Jenis Belanja<x-redstar />
                  </label>
                  <div class="col-lg-9 col-xl-9">
                    <input type="text" class="form-control"
                      value="{{ $data->jenis_belanja->jb_fullkode . ' - ' . $data->jenis_belanja->jb_name }}" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">
                    Sumber Anggaran
                  </label>
                  <div class="col-lg-9 col-xl-9">
                    <select class="form-control" name="b_sumber_anggaran">
                      <option value="" hidden>- Pilih Salah Satu -</option>
                      @foreach (\App\Enums\SumberAnggaranEnum::toArray() as $item)
                        @if ($data->b_sumber_anggaran && $data->b_sumber_anggaran->value == $item['id'])
                          <option value="{{ $item['id'] }}" selected>{{ $item['name'] }}
                          </option>
                        @else
                          <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>

                <x-validation.inline.txtarea name="b_desc" placeholder="Keterangan" :messages="$errors->get('b_desc')">
                  @slot('title')
                    Keterangan
                  @endslot
                  {{ $data->b_desc }}
                </x-validation.inline.txtarea>
              </div>
              <!--end::Wizard Data-->

              <!--begin::Wizard Actions-->
              <div class="d-flex justify-content-between border-top mt-5 pt-10">
                <div class="mr-2"> </div>
                <div>
                  <a href="{{ route('belanja.index') }}"
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
