@props(['messages'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <input {{ $attributes->merge(['class' => 'form-control ' . $errorStr]) }}>
  <x-validation.input-error :messages="$messages" />
</div>
<!--end::Group-->
