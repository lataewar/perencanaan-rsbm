@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Periode Perencanaan">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('periode.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Ubah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('periode.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('periode.update', ['periode' => $data->id]) }}" class="row" method="POST">
    @csrf
    @method('PUT')
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah Periode Perencanaan</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">

              <input type="hidden" name="id" value="{{ $data->id }}">

              <div class="form-group">
                <label for="w_tahun">Tahun
                  <x-redstar />
                </label>
                <div class="">
                  <div class="input-group date">
                    <input type="text" name="w_tahun" value="{{ old('w_tahun') ?? $data->w_tahun }}"
                      class="form-control year_picker @error('w_tahun') is-invalid @enderror" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="la la-calendar"></i>
                      </span>
                    </div>
                    @error('w_tahun')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="w_periode">Periode
                  <x-redstar />
                </label>
                <select class="form-control @error('w_periode') is-invalid @enderror" name="w_periode">
                  <option value="" hidden>- pilih periode -</option>
                  <option value="1" @if (old('w_periode')=="1" || $data->w_periode == "1" ) selected @endif>1</option>
                  <option value="2" @if (old('w_periode')=="2" || $data->w_periode == "2" ) selected @endif>2</option>
                </select>
                @error('w_periode')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="start">Tanggal
                  <x-redstar />
                </label>
                <div class="">
                  <div class="input-daterange input-group renge_picker">
                    <input type="text" class="form-control @error('start') is-invalid @enderror" name="start"
                      value="{{ old('start') ?? $data->w_date_start }}" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                    </div>
                    <input type="text" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') ?? $data->w_date_end }}"
                      readonly />
                    @if ($errors->has('start') || $errors->has('end'))
                      <div class="invalid-feedback">
                        @foreach ([...$errors->get('end'), ...$errors->get('start')] as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                      </div>
                    @endif
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <x-form.submit-group-card route="{{ route('periode.index') }}" />

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
  <script src="{{ asset('js') }}/form/datepicker.js"></script>
  <!--end::Page Scripts-->
@endpush
