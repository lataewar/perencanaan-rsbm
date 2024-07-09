@props([
    'icon' => 'Layout/Layout-top-panel-5.svg',
    'mx' => '1',
    'route',
    'hint',
])

<a href="{{ $route }}" class="btn btn-sm btn-clean btn-icon mx-{{ $mx }}" title="{{ $hint }}">
  <span class="svg-icon svg-icon-md">{!! file_get_contents('assets/media/svg/icons/' . $icon) !!}</span>
</a>
