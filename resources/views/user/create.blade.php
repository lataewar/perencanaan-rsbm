@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="User">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('user.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Tambah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('user.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('user.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah User</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">

              <x-validation.txt-stack type="text" id="name" name="name" placeholder="Nama User"
                value="{{ old('name') }}" :messages="$errors->get('name')">Nama User
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="email" id="email" name="email" placeholder="Email"
                value="{{ old('email') }}" :messages="$errors->get('email')">Email
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="password" id="password" name="password" placeholder="Password"
                value="{{ old('password') }}" :messages="$errors->get('password')">Password
                <x-redstar /></x-validation.txt-stack>

              <x-validation.txt-stack type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Konfirmasi Password" value="{{ old('password_confirmation') }}" :messages="$errors->get('password_confirmation')">Konfirmasi
                Password
                <x-redstar /></x-validation.txt-stack>

              <x-validation.select-static-stack name="role_id" id="role_id" :messages="$errors->get('role_id')">
                Role <x-redstar />
                @slot('items', \App\Enums\UserRoleEnum::toArray())
                @slot('current', old('role_id'))
              </x-validation.select-static-stack>

              <div id="unit" @if (old('role_id') != 5) style="display: none;" @endif>
                <x-validation.select-static-stack name="unit_id" :messages="$errors->get('unit_id')">
                  Unit <x-redstar />
                  @slot('items', $units)
                  @slot('current', old('unit_id'))
                </x-validation.select-static-stack>
              </div>

              <div id="bidang" @if (old('role_id') != 6) style="display: none;" @endif>
                <x-validation.select-static-stack name="bidang_id" :messages="$errors->get('bidang_id')">
                  Bidang <x-redstar />
                  @slot('items', $bidangs)
                  @slot('current', old('bidang_id'))
                </x-validation.select-static-stack>
              </div>

            </div>
          </div>

          <x-form.submit-group-card route="{{ route('user.index') }}" />

        </div>
      </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script>
    $('#role_id').on('change', function() {
      if ($('#role_id').val() == 5) {
        $('#unit').show();
        $('#bidang').hide();
      } else if ($('#role_id').val() == 6) {
        $('#unit').hide();
        $('#bidang').show();
      } else {
        $('#unit').hide();
        $('#bidang').hide();
      }
    });
  </script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
