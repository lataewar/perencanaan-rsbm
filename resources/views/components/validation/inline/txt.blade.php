@props(['messages'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group row">
  <span class="col-xl-3 col-lg-3 col-form-label">{!! $slot !!}</span>
  <div class="col-lg-9 col-xl-9">
    <input {{ $attributes->merge(['class' => 'form-control form-control-lg form-control-solid ' . $errorStr]) }}>
    {{-- <span class="form-text text-muted">info</span> --}}
    <x-validation.input-error :messages="$messages" />
  </div>
</div>
<!--end::Group-->
