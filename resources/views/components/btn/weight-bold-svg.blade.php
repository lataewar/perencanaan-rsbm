<button {{ $attributes->merge(['class' => 'btn font-weight-bolder']) }} >
  <span class="svg-icon svg-icon-md">
    {!! file_get_contents("assets/media/svg/icons/".$svg) !!}
  </span>{{ $slot }}</button>