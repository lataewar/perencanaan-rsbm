@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Belanja">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">

      @can('perencanaan update')
        @can('update', App\Models\Belanja::class)
          <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('belanja.create') }}"
            class="btn-sm btn-light-success btn-create">
            Tambah Rencana Belanja</x-btn.a-weight-bold-svg>
        @endcan
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
  <input type="hidden" id="urx" value="{{ URL('perencanaan/belanja') }}">
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

      <!--begin: Table-->
      <table class="table table-hover">
        <thead>
          <tr class="text-light" style="background-color: #434343;">
            {{-- <th>No</th> --}}
            <th width="10%">Kode</th>
            <th width="20%">Jenis Belanja</th>
            <th width="65%">Detail</th>
            <th width="5%" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($belanjas as $jenbel1)
            <tr class="font-weight-boldest" style="background-color: #dddddd;">
              <td>{{ $jenbel1->jb_fullkode }}</td>
              <td colspan="2">{{ $jenbel1->jb_name }}</td>
              <td class="text-center"></td>
            </tr>

            @foreach ($jenbel1->jenis_belanjas as $jenbel2)
              <tr style="background-color: #efefef;">
                {{-- <td></td> --}}
                <td>{{ $jenbel2->jb_fullkode }}</td>
                <td colspan="2">{{ $jenbel2->jb_name }}</td>
                <td class="text-center"></td>
              </tr>

              @foreach ($jenbel2->jenis_belanjas as $jenbel3)
                <tr class="font-weight-lighter">
                  {{-- <td></td> --}}
                  <td>{{ $jenbel3->jb_fullkode }}</td>
                  <td>{{ $jenbel3->jb_name }}</td>

                  <td>
                    <div class="col-md-11 mt-1 mb-2">
                      <div class="row border-bottom" style="background-color: #f5f5f5;">
                        <div class="col-sm-3 font-size-sm">Nama Barang</div>
                        <div class="col-sm-3 font-size-sm text-right">Harga</div>
                        <div class="col-sm-2 font-size-sm text-right">Jumlah</div>
                        <div class="col-sm-4 font-size-sm text-right">Total</div>
                      </div>
                      @foreach ($jenbel3->barangs as $barang)
                        <div class="row border-bottom"
                          @if ($barang->pivot->is_exist) style="background-color: #fccdd2;" @endif>
                          <div class="col-sm-3 font-size-sm">
                            @if ($barang->pivot->is_exist)
                              <span class="label label-light-danger label-rounded font-weight-bold" data-toggle="tooltip"
                                data-original-title="{{ $barang->pivot->message }}">i</span> &nbsp;
                            @endif
                            {{ $barang->br_name }}
                          </div>
                          <div class="col-sm-3 font-size-sm text-right">{{ formatNomor($barang->pivot->harga) }}</div>
                          <div class="col-sm-2 font-size-sm text-right">{{ formatNomor($barang->pivot->jumlah) }}</div>
                          <div class="col-sm-4 font-size-sm text-right">
                            {{ formatNomor($barang->pivot->harga * $barang->pivot->jumlah) }}</div>
                        </div>
                      @endforeach
                      <div class="row border-bottom" style="background-color: #d7ecff;">
                        <div class="col-sm-3 font-size-sm">Total Belanja</div>
                        <div class="col-sm-9 font-size-sm text-right">{{ formatNomor($jenbel3->total_harga) }}</div>
                      </div>
                    </div>
                    <div class="mt-2 font-size-m font-weight-bold">Sumber Anggaran :
                      {{ $jenbel3->sumber_anggaran ? $jenbel3->sumber_anggaran->getName() : '' }}
                    </div>
                  </td>

                  <td class="text-center">
                    @can('perencanaan read')
                      {!! App\Services\Datatables\DatatableService::btn(
                          'perencanaan/belanja/detail/' . $jenbel3->belanja_id,
                          'Dateil Belanja',
                          'Shopping/Box3.svg',
                      ) !!}
                    @endcan
                    @can('perencanaan update')
                      @can('update', App\Models\Belanja::class)
                        {!! App\Services\Datatables\DatatableService::btn(
                            'perencanaan/belanja/' . $jenbel3->belanja_id . '/edit',
                            'Ubah Belanja',
                            'Design/edit.svg',
                        ) !!}
                      @endcan
                    @endcan
                    @can('perencanaan delete')
                      @can('update', App\Models\Belanja::class)
                        <form action="{{ route('belanja.destroy', ['belanja' => $jenbel3->belanja_id]) }}"
                          class="deleteBelanja" method="POST">
                          @method('DELETE') @csrf
                          <input type="hidden" name="jb_name" value="{{ $jenbel3->jb_name }}">
                          <button type='submit' class='btn btn-sm btn-clean btn-icon mr-2' title='Hapus Data'><span
                              class='svg-icon svg-icon-md'>{!! file_get_contents('assets/media/svg/icons/General/Trash.svg') !!}</span></button>
                        </form>
                      @endcan
                    @endcan
                  </td>

                </tr>
              @endforeach
            @endforeach
          @endforeach
        </tbody>
      </table>
      <!--end: Table-->
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->

  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/belanja.js"></script>
  <!--end::Page Scripts-->
@endpush
