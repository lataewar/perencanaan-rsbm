@props(['messages'])
@props(['span'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <div class="input-group">
    <input {{ $attributes->merge(['class' => 'form-control ' . $errorStr]) }}>
    <div class="input-group-append"><span class="input-group-text">{{ $span }}</span></div>
    <x-validation.input-error :messages="$messages" />
  </div>
</div>
<!--end::Group-->
