@props(['messages'])
@props(['span'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <div class="input-group">
    <div class="input-group-prepend"><span class="input-group-text">{{ $span }}</span></div>
    <input {{ $attributes->merge(['class' => 'form-control ' . $errorStr]) }}>
    <x-validation.input-error :messages="$messages" />
  </div>
</div>
<!--end::Group-->
