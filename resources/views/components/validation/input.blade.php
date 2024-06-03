@props(['messages'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<div class="form-group row">
  <label class="col-xl-3 col-lg-3 col-form-label">{!! $title !!}</label>
  <div class="col-lg-9 col-xl-6">
    <input {{ $attributes->merge(['class' => 'form-control form-control-lg ' . $errorStr]) }}>

    <x-validation.input-error :messages="$messages" />

  </div>
</div>
