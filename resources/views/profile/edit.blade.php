@extends('layouts.template')

@section('subheader')
  <x-subheader title="Profil Pengguna" route="profile.edit">

  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <div class="d-flex flex-row">
    <!--begin::Aside-->
    <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
      <!--begin::Profile Card-->
      <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
          <!--begin::Toolbar-->
          <div class="d-flex justify-content-end">
            &nbsp;
          </div>
          <!--end::Toolbar-->
          <!--begin::User-->
          <div class="d-flex align-items-center">
            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
              <div class="symbol-label" style="background-image:url('{{ asset('assets') }}/media/users/blank.png')"></div>
            </div>
            <div>
              <a href="#"
                class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ auth()->user()->name }}</a>
              <div class="text-muted">{!! auth()->user()->role_id->getLabelHtml() !!}</div>
            </div>
          </div>
          <!--end::User-->
          <!--begin::Contact-->
          <div class="py-9">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="font-weight-bold mr-2">Email:</span>
              <a href="#" class="text-muted text-hover-primary">{{ auth()->user()->email }}</a>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="font-weight-bold mr-2">Telpon:</span>
              <span class="text-muted">-</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <span class="font-weight-bold mr-2">Alamat:</span>
              <span class="text-muted">-</span>
            </div>
          </div>
          <!--end::Contact-->
        </div>
        <!--end::Body-->
      </div>
      <!--end::Profile Card-->
    </div>
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
      <!--begin::Card-->
      <form class="card card-custom card-strech gutter-b" method="post" action="{{ route('profile.update') }}">
        <!--begin::Header-->
        <div class="card-header py-3">
          <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">Informasi Profil Pengguna</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Perbarui informasi profil dan alamat email akun
              Anda</span>
          </div>
          <div class="card-toolbar">
            <x-validation.submit :title="__('Simpan Perubahan')" class="ml-2" />
          </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <div class="form">
          @csrf
          @method('patch')

          <div class="card-body">
            <x-validation.input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
              :messages="$errors->get('name')">
              @slot('title')
                Nama <x-redstar />
              @endslot
            </x-validation.input>

            <x-validation.input-with-icon type="email" name="email" id="email"
              value="{{ old('email', $user->email) }}" :icon="__('la la-at')" :messages="$errors->get('email')">
              @slot('title')
                Email <x-redstar />
              @endslot
            </x-validation.input-with-icon>
          </div>
        </div>
        <!--end::Form-->
      </form>

      <!--begin::Card-->
      <form class="card card-custom" method="post" action="{{ route('password.update') }}">
        <!--begin::Header-->
        <div class="card-header py-3">
          <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">Kata Sandi</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Ganti kata sandi akun anda</span>
          </div>
          <div class="card-toolbar">
            <x-validation.submit :title="__('Simpan Perubahan')" class="ml-2" />
          </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <div class="form">
          @csrf
          @method('put')

          <div class="card-body">

            <x-alert.with-close color="warning">
              Pastikan akun Anda menggunakan kata sandi yang panjang dan acak
              untuk tetap aman.
              <br>kosongkan isian jika tidak mengganti kata sandi.
            </x-alert.with-close>

            <x-validation.input class="mb-2" type="password" name="current_password" id="current_password"
              placeholder="Kata Sandi Terkini" :messages="$errors->updatePassword->get('current_password')">
              @slot('title')
                Kata Sandi Terkini
              @endslot
            </x-validation.input>

            <x-validation.input type="password" name="password" id="password" placeholder="Kata Sandi Baru"
              :messages="$errors->updatePassword->get('password')">
              @slot('title')
                Kata Sandi Baru
              @endslot
            </x-validation.input>

            <x-validation.input type="password" name="password_confirmation" id="password_confirmation"
              placeholder="Konfirmasi Kata Sandi" :messages="$errors->updatePassword->get('password_confirmation')">
              @slot('title')
                Konfirmasi Kata Sandi
              @endslot
            </x-validation.input>

          </div>
        </div>
        <!--end::Form-->
      </form>
    </div>
    <!--end::Content-->
  </div>
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Vendors-->
@endpush
