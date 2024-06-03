@props(['title'])

<button type="submit" {{ $attributes->merge(['class' => 'btn btn-success']) }}>{{ $title }}</button>
