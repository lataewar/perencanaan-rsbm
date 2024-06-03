@extends('layouts.login-template')

@section('content')
  <!--begin::Login-->
  <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
    <!--begin::Aside-->
    <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10"
      style="background-image: url({{ asset('assets/media/bg/bg-8.jpg') }});">
      <!--begin: Aside Container-->
      <div class="d-flex flex-row-fluid flex-column justify-content-between">
        <!--begin: Aside header-->
        <a href="#" class="flex-column-auto mt-5 pb-lg-0 pb-10">
          <img src="{{ asset('media/logo-white-lg.png') }}" class="max-h-120px" alt="" />
        </a>
        <!--end: Aside header-->
        <!--begin: Aside content-->
        <div class="flex-column-fluid d-flex flex-column justify-content-center">
          <h3 class="font-size-h1 mb-5 text-white">Selamat datang di Aplikasi {{ config('app.name') }}.
          </h3>
          <h3 class="font-weight-lighter text-white opacity-80">aplikasi {{ config('app.name') }}</h3>
        </div>
        <!--end: Aside content-->
        <!--begin: Aside footer for desktop-->
        <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
          <div class="opacity-70 font-weight-bold text-white">© {{ date('Y') }} {{ config('app.name') }}</div>
          <div class="d-flex">
            {{-- <a href="#" class="text-white ml-10">Contact</a> --}}
          </div>
        </div>
        <!--end: Aside footer for desktop-->
      </div>
      <!--end: Aside Container-->
    </div>
    <!--begin::Aside-->
    <!--begin::Content-->
    <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
      <!--begin::Content body-->
      <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
        <!--begin::Signin-->
        <div class="login-form login-signin">
          <div class="text-center mb-10 mb-lg-20">
            <h3 class="font-size-h1">Masuk ke aplikasi</h3>
            <p class="text-muted font-weight-bold">Masukkan email dan password anda</p>
          </div>
          <!--begin::Form-->
          <form class="form" action="{{ route('login') }}" method="POST">
            @csrf

            <x-validation.login-input type="text" name="email" id="email" value="{{ old('email') }}"
              placeholder="E-Mail" :messages="$errors->get('email')">
            </x-validation.login-input>

            <x-validation.login-input type="password" name="password" id="password" value="{{ old('password') }}"
              placeholder="Password" :messages="$errors->get('password')">
            </x-validation.login-input>

            <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
              <div class="checkbox-inline">
                <label class="checkbox m-0 text-muted">
                  <input type="checkbox" id="remember_me" name="remember">
                  <span></span>Remember me</label>
              </div>
            </div>
            <!--begin::Action-->
            <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
              <div></div>
              <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Masuk</button>
            </div>
            <!--end::Action-->
          </form>
          <!--end::Form-->
        </div>
        <!--end::Signin-->
      </div>
      <!--end::Content body-->
      <!--begin::Content footer for mobile-->
      <div
        class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
        <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© {{ date('Y') }} {{ config('app.name') }}
        </div>
        <div class="d-flex order-1 order-sm-2 my-2">
          <a href="#" class="text-dark-75 text-hover-primary">Privacy</a>
          <a href="#" class="text-dark-75 text-hover-primary ml-4">Legal</a>
          <a href="#" class="text-dark-75 text-hover-primary ml-4">Contact</a>
        </div>
      </div>
      <!--end::Content footer for mobile-->
    </div>
    <!--end::Content-->
  </div>
  <!--end::Login-->
@endsection
