@props(['messages' => []])

@php
  $is_invalid = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group row">
  <span class="col-xl-3 col-lg-3 col-form-label">{!! $title !!}</span>
  <div class="col-lg-9 col-xl-9">
    <textarea {{ $attributes->merge(['class' => 'form-control form-control-lg ' . $is_invalid]) }}>{{ $slot }}</textarea>
    <x-validation.input-error :$messages />
  </div>
</div>
<!--end::Group-->
