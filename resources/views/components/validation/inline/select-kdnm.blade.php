@props(['messages' => [], 'options' => [], 'current' => null])

@php
  $is_invalid = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group row">
  <label class="col-xl-3 col-lg-3 col-form-label">{!! $slot !!}</label>
  <div class="col-lg-9 col-xl-9">
    <select {{ $attributes->merge(['class' => 'form-control form-control-lg ' . $is_invalid]) }}>
      <option value="" hidden>- Pilih Salah Satu -</option>
      @foreach ($options as $item)
        @if ($current == $item->id)
          <option value="{{ $item->id }}" selected>{{ $item->fullkode . ' - ' . $item->name }}
          </option>
        @else
          <option value="{{ $item->id }}">{{ $item->fullkode . ' - ' . $item->name }}</option>
        @endif
      @endforeach
    </select>
    <x-validation.input-error :$messages />
  </div>
</div>
<!--end::Group-->
