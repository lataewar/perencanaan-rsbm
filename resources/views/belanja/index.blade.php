@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@php
  $isCanUpdateBelanja = auth()
      ->user()
      ->can('update', App\Models\Belanja::class);
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
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  @include('layouts.flash-data')

  <!--begin::Card-->
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
        @if ($data->total > 0)
          <a href="{{ route('belanja.cetak', $data->id) }}" class="btn btn-sm btn-warning font-weight-bold">
            <i class="flaticon2-printer"></i> Cetak
          </a>
        @endif
      </div>
    </div>
    <div class="card-body">

      <div class="row justify-content-center mb-4">
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
                <span class="text-right font-weight-light">{!! App\Enums\StatusEnum::from($data->status)->getLabelHTML() !!}</span>
              </div>
              <x-separator margin="2" />
              <div class="d-flex justify-content-between text-primary">
                <span class="font-weight-boldest mr-15">Total Belanja</span>
                <span class="text-right font-weight-boldest">{{ formatNomor($data->total) }}</span>
              </div>
              <div class="separator separator-dashed my-1"></div>

            </div>
          </div>
        </div>
      </div>
      <x-separator margin="5" />

      <div class="row">

        <div class="col-md-5 px-1">

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
                    <div class="font-weight-bold font-size-md text-success pb-2">{{ $usulan->ul_name }}</div>
                    <div class="row border-bottom" style="background-color: #f5f5f5;">
                      <div class="col-sm-2 font-size-sm text-right">jml</div>
                      <div class="col-sm-4 font-size-sm text-right">harga</div>
                      <div class="col-sm-6 font-size-sm text-right">total</div>
                    </div>
                    <div class="row border-bottom font-weight-bold">
                      <div class="col-sm-2 font-size-sm text-right">{{ $usulan->ul_qty }}</div>
                      <div class="col-sm-4 font-size-sm text-right">{{ formatNomor($usulan->ul_prise) }}</div>
                      <div class="col-sm-6 font-size-sm text-right">
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

        <div class="col-md-7 px-1">

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
                <tr class="font-weight-boldest py-0" style="background-color: #dddddd;">
                  <td class="py-0">{{ $jenbel1->jb_fullkode }}</td>
                  <td class="py-0">{{ $jenbel1->jb_name }}</td>
                  <td class="text-center py-0"></td>
                </tr>

                @foreach ($jenbel1->jenis_belanjas as $jenbel2)
                  <tr class="py-0" style="background-color: #efefef;">
                    <td class="py-0">{{ $jenbel2->jb_fullkode }}</td>
                    <td class="py-0">{{ $jenbel2->jb_name }}</td>
                    <td class="text-center py-0"></td>
                  </tr>

                  @foreach ($jenbel2->jenis_belanjas as $jenbel3)
                    <tr class="font-weight-lighter py-0" style="background-color: #f5f5f5;">
                      <td class="py-0">{{ $jenbel3->jb_fullkode }}</td>
                      <td class="py-0"> {{ $jenbel3->jb_name }}</td>
                      <td class="text-center py-0"></td>

                    </tr>

                    <tr class="font-weight-lighter py-0">
                      <td class="py-0" colspan="3">
                        <div class="col-md-12 mt-1 mb-2">
                          <div class="row border-bottom font-weight-bold" style="background-color: #f5f5f5;">
                            <div class="col-sm-3 font-size-sm">nama brg</div>
                            <div class="col-sm-1 font-size-sm text-right">jml</div>
                            <div class="col-sm-2 font-size-sm text-right">harga</div>
                            <div class="col-sm-3 font-size-sm text-right">total</div>
                            <div class="col-sm-2 font-size-sm text-right">ket.</div>
                            <div class="col-sm-1 font-size-sm text-right"></div>
                          </div>

                          @foreach ($jenbel3->barangs as $barang)
                            <div class="row border-bottom"
                              @if ($barang->pivot->is_exist) style="background-color: #fccdd2;" @endif>
                              <div class="col-sm-3 font-size-sm pt-2">
                                @if ($barang->pivot->is_exist)
                                  <span class="label label-light-danger label-rounded font-weight-bold"
                                    data-toggle="tooltip" data-original-title="{{ $barang->pivot->message }}">i</span>
                                  &nbsp;
                                @endif
                                {{ $barang->br_name }}
                              </div>
                              <div class="col-sm-1 font-size-sm text-right pt-2">
                                {{ formatNomor($barang->pivot->jumlah) }}
                              </div>
                              <div class="col-sm-2 font-size-sm text-right pt-2">
                                {{ formatNomor($barang->pivot->harga) }}
                              </div>
                              <div class="col-sm-3 font-size-sm text-right pt-2">
                                {{ formatNomor($barang->pivot->harga * $barang->pivot->jumlah) }}</div>
                              <div class="col-sm-2 font-size-sm text-right pt-2">
                                {!! $barang->pivot->sumber_anggaran
                                    ? App\Enums\SumberAnggaranEnum::from($barang->pivot->sumber_anggaran)->getName()
                                    : '' !!}
                              </div>
                              <div class="col-sm-1 font-size-sm text-right">
                                <x-table.menu-dropdown>

                                  @can('perencanaan update')
                                    @if ($isCanUpdateBelanja)
                                      <x-table.nav-item :route="route('belanja.edit', [
                                          'barang' => $barang->pivot->barang_id,
                                          'belanja' => $barang->pivot->belanja_id,
                                      ])" name="Ubah" icon="la la-pencil" />
                                      <x-table.nav-item route="javascript:;" name="Hapus" icon="la la-trash"
                                        :belanja="$barang->pivot->belanja_id" :barang="$barang->pivot->barang_id" :namabarang="$barang->br_name" :usulan="$barang->pivot->usulan_id" />
                                    @endif
                                  @endcan

                                </x-table.menu-dropdown>
                              </div>
                            </div>
                          @endforeach

                          <div class="row border-bottom" style="background-color: #d7ecff;">
                            <div class="col-sm-6 font-size-sm">Total Belanja</div>
                            <div class="col-sm-3 font-size-sm text-right">{{ formatNomor($jenbel3->total_harga) }}</div>
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
  <script src="{{ asset('js') }}/belanja.js"></script>
  <!--end::Page Scripts-->
@endpush
