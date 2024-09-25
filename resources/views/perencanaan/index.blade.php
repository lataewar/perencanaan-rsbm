@extends('layouts.template')

@push('css')
@endpush

@section('subheader')
  <x-subheader title="Perencanaan">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">
    </div>
  </x-subheader>
@endsection

@use('App\Enums\StatusEnum', 'StatusEnum')

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  @can('perencanaan accept')
    <input type="hidden" id="urx_accept" value="{{ route('perencanaan.accept') }}">
    <input type="hidden" id="urx_reject" value="{{ route('perencanaan.reject') }}">
  @endcan
  @can('perencanaan validate')
    <input type="hidden" id="urx_validate" value="{{ route('perencanaan.validate') }}">
    <input type="hidden" id="urx_reject" value="{{ route('perencanaan.reject') }}">
  @endcan

  @php
    $statuses = [];
    if (auth()->user()->role_id->isBidang()) {
      $statuses = StatusEnum::toArrayRoleBIdang();
    } elseif (auth()->user()->role_id->isPerencana()) {
      $statuses = StatusEnum::toArrayRolePerencana();
    } else {
      $statuses = StatusEnum::toArray();
    }
  @endphp

  <div class="card card-custom gutter-b">
    <div class="card-body">

      <!--begin: Search Form-->
      <form action="{{ route('perencanaan.setfilter', request()->query()) }}" method="POST"> @csrf

        <div class="row justify-content-center">
          <div class="col-lg-9 col-xl-8">
            <div class="row justify-content-center">
              @unlessrole('unit')
                <div class="my-2 col-md-5 my-md-0">
                  <select class="form-control form-control-solid" name="units">
                    <option value="">Semua Unit</option>
                    @foreach ($units as $item)
                      <option value="{{ $item->id }}" @if (session()->get('ptable.units') == $item->id) selected @endif>
                        {{ $item->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              @endunlessrole
              <div class="my-2 col-md-4 my-md-0">
                <select class="form-control form-control-solid" name="status">
                  <option value="">Semua Status</option>
                  @foreach ($statuses as $item)
                    <option value="{{ $item['id'] }}" @if (session()->get('ptable.status') == $item['id']) selected @endif>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="my-2 col-md-3 my-md-0">

                <div class="row">
                  <div class="col-md-6">
                    <button type="submit" name="action" value="submit" class="form-control btn btn-light-primary">
                      <i class="p-0 la la-search"></i>
                    </button>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" name="action" value="reset" class="form-control btn btn-secondary">
                      <i class="p-0 la la-close"></i>
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </form>

      @include('layouts.validation-error')
      <x-separator margin="8" />

      <!--begin: Table-->
      <div class="table-responsive-md">
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Unit / Tahun</th>
              <th class="text-center">Waktu</th>
              <th class="text-center">Status</th>
              <th class="text-right">Total Anggaran</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
              @php
                $status = StatusEnum::from($item->status);
              @endphp
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <span class='font-weight-bold'>{{ $item->u_name }}</span><br>
                  <span class='font-size-sm text-success'>{{ $item->p_tahun }}</span>
                </td>
                <td class="text-center">
                  <div class=''>{{ formatTime($item->st_created_at) }}</div>
                  <div class='font-size-sm font-weight-light text-muted'>
                    {{ formatTDFH($item->st_created_at) }}
                  </div>
                </td>
                <td class="text-center">
                  {!! $status->getLabelHTML() !!}
                </td>
                <td class="text-right">
                  {{ formatNomor($item->total) }}
                </td>
                <td class="text-center">

                  <x-table.menu-dropdown>

                    @can('perencanaan read')
                      <x-table.nav-item :route="route('perencanaan.belanja', ['perencanaan' => $item->id])" name="Detail Belanja" icon="la la-money-check-alt" />
                    @endcan

                    @if (auth()->user()->can('perencanaan accept') && $status->isDivalidasi() && $item->total > 0)
                      <x-table.nav-item route="javascript:;" name="Terima" icon="la la-check-circle-o" :$item />
                      <x-table.nav-item route="javascript:;" name="Tolak" icon="la la-times-circle-o" :$item />
                    @endif

                    @if (auth()->user()->can('perencanaan validate') && $status->isDikirim())
                      <x-table.nav-item route="javascript:;" name="Validasi" icon="la la-check-circle-o" :$item />
                      <x-table.nav-item route="javascript:;" name="Tolak" icon="la la-times-circle-o" :$item />
                    @endif

                    @if ($item->total > 0)
                      <x-table.nav-separator />
                      <x-table.nav-item :route="route('perencanaan.cetak', $item->id)" name="Cetak Excell" icon="la la-print" />
                    @endif

                  </x-table.menu-dropdown>

                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <!--end: Table-->
      </div>

      <!--start: pagination-->
      <div class="flex-wrap d-flex justify-content-between align-items-center">

        <div class="flex-wrap py-2 mr-3 d-flex">
          {!! $data->appends(request()->input())->links('layouts.paginator') !!}
        </div>

        <div class="py-3 d-flex align-items-center">
          <form action="{{ route('perencanaan.setfilter', request()->query()) }}" method="post">@csrf
            <select class="mr-4 border-0 form-control form-control-sm text-primary font-weight-bold bg-light-primary"
              style="width: 75px;" name="per_page" onchange="setPerPage(this)">
              @foreach ([10, 25, 50, 100] as $item)
                <option value="{{ $item }}" @if (session()->get('ptable.per_page') == $item) selected @endif>
                  {{ $item }}
                </option>
              @endforeach
            </select>
          </form>
          <span class="text-muted">Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari
            {{ $data->total() }} data</span>
        </div>
      </div>
      <!--end: pagination-->

    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->

  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/table/table.js"></script>
  <!--end::Page Scripts-->
@endpush
