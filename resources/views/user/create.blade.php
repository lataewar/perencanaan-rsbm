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
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <div class="card card-custom gutter-b">
    <div class="card-body">
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
                    placeholder="Konfirmasi Password" value="{{ old('password_confirmation') }}"
                    :messages="$errors->get('password_confirmation')">Konfirmasi Password
                    <x-redstar /></x-validation.txt-stack>

                  <x-validation.select-static-stack name="role_id" :messages="$errors->get('role_id')">
                    Role <x-redstar />
                    @slot('items', \App\Enums\UserRole::toArray())
                  </x-validation.select-static-stack>

                </div>
              </div>
            </div>

            <x-form.submit-group-card route="{{ route('user.index') }}" />

          </div>
        </div>
      </form>
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->

  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
