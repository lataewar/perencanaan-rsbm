@props(['messages'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group">
  <label>{!! $title !!}</label>
  <textarea {{ $attributes->merge(['class' => 'form-control ' . $errorStr]) }}>{{ $slot }}</textarea>
  <x-validation.input-error :messages="$messages" />
</div>
<!--end::Group-->
