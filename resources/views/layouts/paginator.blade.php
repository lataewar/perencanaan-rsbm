@if ($paginator->hasPages())

  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
        class="ki ki-bold-double-arrow-back icon-xs"></i></a>
    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
        class="ki ki-bold-arrow-back icon-xs"></i></a>
  @else
    <a href="{{ $paginator->url(1) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i
        class="ki ki-bold-double-arrow-back icon-xs"></i></a>
    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i
        class="ki ki-bold-arrow-back icon-xs"></i></a>
  @endif

  @php
    $cp = $paginator->currentPage();
    $lp = $paginator->lastPage();
    $pages = [];
    if ($cp - 2 > 0) {
        array_push($pages, $cp - 2);
    }
    if ($cp - 1 > 0) {
        array_push($pages, $cp - 1);
    }
    array_push($pages, $cp);
    if ($cp + 1 <= $lp) {
        array_push($pages, $cp + 1);
    }
    if ($cp + 2 <= $lp) {
        array_push($pages, $cp + 2);
    }
  @endphp

  {{-- Pagination Elements --}}
  @foreach ($pages as $item)
    @if ($item == $paginator->currentPage())
      <span class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">{{ $item }}</span>
    @else
      <a href="{{ $paginator->url($item) }}"
        class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $item }}</a>
    @endif
  @endforeach

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i
        class="ki ki-bold-arrow-next icon-xs"></i></a>
    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i
        class="ki ki-bold-double-arrow-next icon-xs"></i></a>
  @else
    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
        class="ki ki-bold-arrow-next icon-xs"></i></a>
    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
        class="ki ki-bold-double-arrow-next icon-xs"></i></a>
  @endif
@else
  <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
      class="ki ki-bold-double-arrow-back icon-xs"></i></a>
  <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
      class="ki ki-bold-arrow-back icon-xs"></i></a>
  <span class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1 disabled">1</span>
  <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
      class="ki ki-bold-arrow-next icon-xs"></i></a>
  <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i
      class="ki ki-bold-double-arrow-next icon-xs"></i></a>
@endif
