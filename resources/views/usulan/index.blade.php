@extends('layouts.template')

@push('css')
@endpush

@section('subheader')
  <x-subheader title="Usulan">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">
      {{-- @can('perencanaan create') --}}
      <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('usulan.create') }}"
        class="btn-sm btn-light-success btn-create">
        Tambah Data</x-btn.a-weight-bold-svg>
      {{-- @endcan --}}
    </div>
  </x-subheader>
@endsection

@use('App\Enums\StatusEnum', 'StatusEnum')

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
  @can('perencanaan delete')
    <input type="hidden" id="urx" value="{{ route('usulan.destroy') }}">
  @endcan
  @can('perencanaan send')
    <input type="hidden" id="urx_send" value="{{ route('usulan.send') }}">
  @endcan
  <div class="card card-custom gutter-b">
    <div class="card-body">

      <!--begin: Search Form-->
      <form action="{{ route('usulan.setfilter', request()->query()) }}" method="POST"> @csrf

        <div class="row justify-content-center">
          <div class="col-lg-9 col-xl-8">
            <div class="row justify-content-center">
              @unlessrole('unit')
                <div class="col-md-5 my-2 my-md-0">
                  <select class="form-control form-control-solid" name="units">
                    <option value="">Semua Unit</option>
                    @foreach ($units as $item)
                      <option value="{{ $item->id }}" @if (session()->get('utable.units') == $item->id) selected @endif>
                        {{ $item->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              @endunlessrole
              <div class="col-md-4 my-2 my-md-0">
                <select class="form-control form-control-solid" name="status">
                  <option value="">Semua Status</option>
                  @foreach (StatusEnum::toArray() as $item)
                    <option value="{{ $item['id'] }}" @if (session()->get('utable.status') == $item['id']) selected @endif>
                      {{ $item['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 my-2 my-md-0">

                <div class="row">
                  <div class="col-md-6">
                    <button type="submit" name="action" value="submit" class="form-control btn btn-light-primary">
                      <i class="la la-search p-0"></i>
                    </button>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" name="action" value="reset" class="form-control btn btn-secondary">
                      <i class="la la-close p-0"></i>
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
              <th class="text-right">Jumlah Barang</th>
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
                  {{ formatNomor($item->usulans_count) }}
                </td>
                <td class="text-center">

                  <x-table.menu-dropdown>

                    @if (auth()->user()->can('perencanaan send') && ($status->isDraft() || $status->isDitolak()) && $item->usulans_count > 0)
                      <x-table.nav-item route="javascript:;" name="Kirim" icon="la la-send" :$item />
                      <x-table.nav-separator />
                    @endif


                    @if ($item->usulans_count > 0)
                      <x-table.nav-item :route="route('usulan.cetak', $item->id)" name="Cetak Excell" icon="la la-print" />
                      <x-table.nav-separator />
                    @endif

                    @can('perencanaan read')
                      <x-table.nav-item :route="route('usulan.usul', ['usul' => $item->id])" name="Detail Usulan" icon="la la-boxes" />
                    @endcan

                    @can('perencanaan delete')
                      <x-table.nav-item route="javascript:;" name="Hapus" icon="la la-trash" :$item />
                    @endcan

                  </x-table.menu-dropdown>

                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <!--end: Table-->
      </div>

      <!--start: pagination-->
      <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div class="d-flex flex-wrap py-2 mr-3">
          {!! $data->appends(request()->input())->links('layouts.paginator') !!}
        </div>

        <div class="d-flex align-items-center py-3">
          <form action="{{ route('usulan.setfilter', request()->query()) }}" method="post">@csrf
            <select class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary"
              style="width: 75px;" name="per_page" onchange="setPerPage(this)">
              @foreach ([10, 25, 50, 100] as $item)
                <option value="{{ $item }}" @if (session()->get('utable.per_page') == $item) selected @endif>
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
