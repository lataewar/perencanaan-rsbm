@if ($errors->any())
  <div class="my-3">
    {!! implode(
        '',
        $errors->all('<span class="row justify-content-center font-size-sm text-danger">:message</span>'),
    ) !!}
  </div>
@endif
