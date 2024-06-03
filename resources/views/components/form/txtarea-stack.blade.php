<!--begin::Group-->
<div class="form-group">
  <label>{!! $title !!}</label>
  <textarea class="form-control" name="{{ $name }}" {{ $attributes }}>{{ $slot }}</textarea>
  <div class="invalid-feedback error-{{ $name }}"></div>
</div>
<!--end::Group-->
