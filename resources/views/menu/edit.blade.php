@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Menu">
    <x-slot name="breadcrumb">
      <x-bc.item route="{{ route('menu.index') }}">Data</x-bc.item>
      <x-bc.separator />
      <x-bc.item route="#">Ubah Data</x-bc.item>
    </x-slot>

    <x-btn.a-weight-bold-svg href="{{ route('menu.index') }}" svg="Navigation/Angle-left.svg"
      class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <div class="card card-custom gutter-b">
    <div class="card-body">
      <form action="{{ route('menu.update', ['menu' => $data->id]) }}" class="row" method="POST">
        @csrf
        @method('PUT')
        <div class="col-md-12">
          <div class="card card-custom card-stretch gutter-b">
            <div class="card-header">
              <h3 class="card-title">Ubah Menu</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <x-validation.txt-stack type="text" id="name" name="name" placeholder="Nama Menu"
                    value="{{ old('name') ?? $data->name }}" :messages="$errors->get('name')">Nama Menu
                    <x-redstar /></x-validation.txt-stack>

                  <x-form.txt-stack name="route" value="{{ old('route') ?? $data->route }}">Route </x-form.txt-stack>
                  <x-form.switch-stack name="has_submenu">
                    @slot('checked')
                      @php $submenu = old('has_submenu') ?? $data->has_submenu; @endphp
                      @if (!$submenu)
                        0
                      @else
                        1
                      @endif
                    @endslot
                    Has Submenu
                  </x-form.switch-stack>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Icons</label>
                    <select class="form-control selectpicker" name="icon" data-live-search="true" data-size="6">
                      @foreach (\App\Helpers\SvgIcons::all() as $icon)
                        <option
                          data-content="<img src='{{ asset('assets/media/svg/icons/' . $icon) }}'/>
                          &nbsp; &nbsp; {{ $icon }}"
                          value="{{ $icon }}" @php echo (old('icon') ?? $data->icon) == $icon ? "selected" : "" @endphp>
                        </option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback error-icon"></div>
                  </div>
                  <x-form.txtarea-stack name="desc" placeholder="Keterangan">
                    @slot('title')
                      Keterangan
                    @endslot
                    {{ old('desc') ?? $data->desc }}
                  </x-form.txtarea-stack>
                </div>
              </div>
            </div>

            <x-form.submit-group-card route="{{ route('menu.index') }}" />

          </div>
        </div>
      </form>
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/app.js"></script>
  <!--end::Page Scripts-->
@endpush
