<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <div class="">
    <input 
      data-switch="true" type="checkbox" data-on-text="Ya" 
      data-handle-width="50" data-off-text="Tidak" 
      data-on-color="primary" data-off-color="warning" 
      {!! $attributes !!} 
      @if($checked == "1")
        checked="checked"
      @endif
      />
  </div>
</div>
<!--end::Group-->