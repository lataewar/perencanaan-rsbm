@props(['messages', 'icon'])

<div class="form-group row">
  <label class="col-xl-3 col-lg-3 col-form-label">{!! $title !!}</label>
  <div class="col-lg-9 col-xl-6">
    <div class="input-group input-group-lg">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="{{ $icon }}"></i>
        </span>
      </div>
      <input class="form-control form-control-lg {{ $messages ? 'is-invalid' : '' }}" {{ $attributes }}>

      <x-validation.input-error :messages="$messages" />
    </div>
  </div>
</div>
