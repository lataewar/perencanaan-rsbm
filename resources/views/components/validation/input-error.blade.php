@props(['messages'])

@if ($messages)
  <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
    @foreach ((array) $messages as $message)
      <li>{{ $message }}</li>
    @endforeach
  </div>
@endif
