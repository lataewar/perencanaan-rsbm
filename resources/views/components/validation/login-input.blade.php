@props(['messages'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<div class="form-group">
  <input {{ $attributes->merge(['class' => 'form-control form-control-solid h-auto py-5 px-6 ' . $errorStr]) }}>

  <x-validation.input-error :messages="$messages" />
</div>
