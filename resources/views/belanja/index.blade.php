@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@php
  $isCanUpdateBelanja = auth()
      ->user()
      ->can('update', App\Models\Belanja::class);
  $status = App\Enums\StatusEnum::from($data->status);
@endphp

@section('subheader')
  <x-subheader title="Belanja">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">

      @can('perencanaan update')
        @if ($isCanUpdateBelanja)
          <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('belanja.create') }}"
            class="btn-sm btn-light-success btn-create">
            Tambah Rencana Belanja</x-btn.a-weight-bold-svg>
        @endif
      @endcan
    </div>

    <x-btn.a-weight-bold-svg href="{{ route('perencanaan.index') }}" svg="Navigation/Angle-left.svg"
      class="ml-2 btn-sm btn-light-primary">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

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
  <input type="hidden" id="urx" value="{{ route('belanja.index') }}">
  <div class="card card-custom gutter-b">
    <div class="card-header">
      <div class="card-title">
        <span class="card-icon">
          <i class="flaticon2-website text-primary"></i>
        </span>
        <h3 class="card-label">
          Detail Perencanaan
          <small>Belanja</small>
        </h3>
      </div>
      <div class="card-toolbar">
        <div>
          <x-table.menu-dropdown>

            @if (auth()->user()->can('perencanaan accept') && $status->isDivalidasi() && $data->total > 0)
              <x-table.nav-item route="javascript:;" name="Terima" icon="la la-check-circle-o" :item="$data" />
              <x-table.nav-item route="javascript:;" name="Tolak" icon="la la-times-circle-o" :item="$data" />
              <x-table.nav-separator />
            @endif
            @if (auth()->user()->can('perencanaan validate') && $status->isDikirim())
              <x-table.nav-item route="javascript:;" name="Validasi" icon="la la-check-circle-o" :item="$data" />
              <x-table.nav-item route="javascript:;" name="Tolak" icon="la la-times-circle-o" :item="$data" />
              <x-table.nav-separator />
            @endif

            @if ($data->total > 0)
              <x-table.nav-item :route="route('perencanaan.cetak', $data->id)" name="Cetak Excell" icon="la la-print" />
            @endif

          </x-table.menu-dropdown>
        </div>
      </div>
    </div>
    <div class="card-body">

      <div class="mb-4 row justify-content-center">
        <div class="col-lg-6">
          <div class="text-dark-50 line-height-lg">
            <div class="d-flex flex-column">

              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Unit:</span>
                <span class="text-right font-weight-light">{{ $data->u_name }}</span>
              </div>
              <x-separator margin="1" />
              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Tahun/Periode:</span>
                <span class="text-right font-weight-light">{{ $data->p_tahun . ' / ' . $data->p_periode }}</span>
              </div>
              <x-separator margin="1" />
              <div class="d-flex justify-content-between">
                <span class="font-weight-bold mr-15">Status Pengajuan:</span>
                <button type="button" style="margin: 0; padding: 0; border: 0; background-color: transparent;"
                  class="btn btn-primary" data-toggle="popover" data-trigger="click" data-placement="bottom"
                  title="Riwayat Status" data-html="true"
                  data-content="
                    @foreach ($statuses->reverse() as $item)
                    <x-status-list
                    :data="$item" /> @endforeach
                  ">
                  {!! $status->getLabelHTML() !!}
                </button>
              </div>
              <x-separator margin="2" />
              <div class="d-flex justify-content-between text-primary">
                <span class="font-weight-boldest mr-15">Total Belanja</span>
                <span class="text-right font-weight-boldest">{{ formatNomor($data->total) }}</span>
              </div>
              <div class="my-1 separator separator-dashed"></div>

            </div>
          </div>
        </div>
      </div>
      <x-separator margin="5" />

      <div class="row">

        <div class="px-1 col-md-5">
          <h5 class="mb-4 text-center font-weight-light">Tabel Usulan</h5>
          <!--begin: Table Usulan-->
          <table class="table table-hover">
            <thead>
              <tr class="text-light" style="background-color: #434343;">
                <th width="8%">No</th>
                <th width="82%">Detail</th>
                <th width="10%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($usulans as $usulan)
                <tr @if ($usulan->is_accommodated) class="table-success" @endif>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    <div class="pb-2 font-weight-bold font-size-md text-success">{{ $usulan->ul_name }}</div>
                    <div class="row border-bottom" style="background-color: #f5f5f5;">
                      <div class="text-right col-sm-2 font-size-sm">jml</div>
                      <div class="text-right col-sm-4 font-size-sm">harga</div>
                      <div class="text-right col-sm-6 font-size-sm">total</div>
                    </div>
                    <div class="row border-bottom font-weight-bold">
                      <div class="text-right col-sm-2 font-size-sm">{{ $usulan->ul_qty }}</div>
                      <div class="text-right col-sm-4 font-size-sm">{{ formatNomor($usulan->ul_prise) }}</div>
                      <div class="text-right col-sm-6 font-size-sm">
                        {{ formatNomor($usulan->ul_qty * $usulan->ul_prise) }}
                      </div>
                    </div>
                  </td>
                  <td class="text-center">
                    @can('perencanaan update')
                      @if ($isCanUpdateBelanja && !$usulan->is_accommodated)
                        <x-table.a :route="route('belanja.create.usulan', $usulan->id)" hint="Akomodir ke perencanaan" icon="Code/Plus.svg" />
                      @endif
                    @endcan
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <!--end: Table Usulan-->

        </div>

        <div class="px-1 col-md-7">
          <h5 class="mb-4 text-center font-weight-light">Tabel Perencanaan</h5>
          <!--begin: Table Perencanaan-->
          <table class="table table-hover">
            <thead>
              <tr class="text-light" style="background-color: #434343;">
                <th width="10%">Kode</th>
                <th width="85%">Detail</th>
                <th width="5%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($belanjas as $jenbel1)
                <tr class="py-0 font-weight-boldest" style="background-color: #dddddd;">
                  <td class="py-0">{{ $jenbel1->jb_fullkode }}</td>
                  <td class="py-0">{{ $jenbel1->jb_name }}</td>
                  <td class="py-0 text-center"></td>
                </tr>

                @foreach ($jenbel1->jenis_belanjas as $jenbel2)
                  <tr class="py-0" style="background-color: #efefef;">
                    <td class="py-0">{{ $jenbel2->jb_fullkode }}</td>
                    <td class="py-0">{{ $jenbel2->jb_name }}</td>
                    <td class="py-0 text-center"></td>
                  </tr>

                  @foreach ($jenbel2->jenis_belanjas as $jenbel3)
                    <tr class="py-0 font-weight-lighter" style="background-color: #f5f5f5;">
                      <td class="py-0">{{ $jenbel3->jb_fullkode }}</td>
                      <td class="py-0"> {{ $jenbel3->jb_name }}</td>
                      <td class="py-0 text-center"></td>

                    </tr>

                    <tr class="py-0 font-weight-lighter">
                      <td class="py-0" colspan="3">
                        <div class="mt-1 mb-2 col-md-12">
                          <div class="row border-bottom font-weight-bold" style="background-color: #f5f5f5;">
                            <div class="col-sm-3 font-size-sm">nama brg</div>
                            <div class="text-right col-sm-1 font-size-sm">jml</div>
                            <div class="text-right col-sm-2 font-size-sm">harga</div>
                            <div class="text-right col-sm-3 font-size-sm">total</div>
                            <div class="text-right col-sm-2 font-size-sm">ket.</div>
                            <div class="text-right col-sm-1 font-size-sm"></div>
                          </div>

                          @foreach ($jenbel3->barangs as $barang)
                            <div class="row border-bottom"
                              @if ($barang->pivot->is_exist) style="background-color: #fccdd2;" @endif>
                              <div class="pt-2 col-sm-3 font-size-sm">
                                @if ($barang->pivot->is_exist)
                                  <span class="label label-light-danger label-rounded font-weight-bold"
                                    data-toggle="tooltip" data-original-title="{{ $barang->pivot->message }}">i</span>
                                  &nbsp;
                                @endif
                                {{ $barang->br_name }}
                              </div>
                              <div class="pt-2 text-right col-sm-1 font-size-sm">
                                {{ formatNomor($barang->pivot->jumlah) }}
                              </div>
                              <div class="pt-2 text-right col-sm-2 font-size-sm">
                                {{ formatNomor($barang->pivot->harga) }}
                              </div>
                              <div class="pt-2 text-right col-sm-3 font-size-sm">
                                {{ formatNomor($barang->pivot->harga * $barang->pivot->jumlah) }}</div>
                              <div class="pt-2 text-right col-sm-2 font-size-sm">
                                {!! $barang->pivot->sumber_anggaran
                                    ? App\Enums\SumberAnggaranEnum::from($barang->pivot->sumber_anggaran)->getName()
                                    : '' !!}
                              </div>
                              <div class="text-right col-sm-1 font-size-sm">
                                <x-table.menu-dropdown>

                                  @can('perencanaan update')
                                    @if ($isCanUpdateBelanja)
                                      <x-table.nav-item :route="route('belanja.edit', [
                                        'pivot' => $barang->pivot->id,
                                      ])" name="Ubah" icon="la la-pencil" />
                                      <x-table.nav-item route="javascript:;" name="Hapus" icon="la la-trash"
                                        :belanja="$barang->pivot->belanja_id" :pivotid="$barang->pivot->id" :namabarang="$barang->br_name" :usulan="$barang->pivot->usulan_id" />
                                    @endif
                                  @endcan

                                </x-table.menu-dropdown>
                              </div>
                            </div>
                          @endforeach

                          <div class="row border-bottom" style="background-color: #d7ecff;">
                            <div class="col-sm-6 font-size-sm">Total Belanja</div>
                            <div class="text-right col-sm-3 font-size-sm">{{ formatNomor($jenbel3->total_harga) }}</div>
                          </div>

                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endforeach
              @endforeach
            </tbody>
          </table>
          <!--end: Table Perencanaan-->

        </div>

      </div>
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script>
    $(document).ready(function() {
      const element = document.getElementById("kt_body");
      element.classList.add("aside-minimize");
    });
  </script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/table/table.js"></script>
  <!--end::Page Scripts-->
@endpush
