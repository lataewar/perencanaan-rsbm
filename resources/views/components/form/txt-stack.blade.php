<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <input type="text" class="form-control" name="{{ $name }}" {{ $attributes }}>
  <div class="invalid-feedback error-{{ $name }}"></div>
</div>
<!--end::Group-->