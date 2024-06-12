@section('content')
  <!--begin::Card-->
  <form action="{{ route('perencanaan.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Perencanaan</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-9">
              <!--begin::Wizard Form-->
              <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form" action="" method="POST">
                @csrf

                <!--begin::Wizard Data-->
                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                  <h3 class="mb-10 font-weight-bold text-dark">Isi Data Permohonan</h3>
                  <!--begin::Input-->

                  <!--begin::Group-->
                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Tahun</label>
                    <div class="col-lg-9 col-xl-9">
                      <select class='form-control form-control-lg form-control-solid' name="p_tahun">
                        <option value="" hidden>- Pilih Salah Satu -</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                      </select>
                      <x-validation.input-error :messages="$errors->get('p_tahun')" />
                    </div>
                  </div>
                  <!--end::Group-->

                  <x-separator margin="10" />

                  <x-validation.inline.txt type="text" name="tr_asal_instansi" placeholder="Asal Instansi / Lembaga"
                    value="{{ old('tr_asal_instansi') }}" :messages="$errors->get('tr_asal_instansi')">Asal
                    Instansi / Lembaga<x-redstar />
                  </x-validation.inline.txt>

                  <x-validation.inline.txtarea name="tr_alamat_instansi" placeholder="Alamat Instansi / Lembaga"
                    :messages="$errors->get('tr_alamat_instansi')">
                    @slot('title')
                      Alamat Instansi / Lembaga<x-redstar />
                    @endslot
                    {{ old('tr_alamat_instansi') }}
                  </x-validation.inline.txtarea>

                  <x-validation.inline.txt type="text" name="tr_nama_kegiatan" placeholder="Nama Kegiatan"
                    value="{{ old('tr_nama_kegiatan') }}" :messages="$errors->get('tr_nama_kegiatan')">Nama Kegiatan<x-redstar />
                  </x-validation.inline.txt>

                  <x-validation.inline.txt type="text" name="tr_tempat_kegiatan" placeholder="Tempat Kegiatan"
                    value="{{ old('tr_tempat_kegiatan') }}" :messages="$errors->get('tr_tempat_kegiatan')">Tempat Kegiatan<x-redstar />
                  </x-validation.inline.txt>

                  <x-validation.inline.txt type="text" name="tr_waktu_kegiatan" class="datetimepicker-input"
                    placeholder="Pilih Tanggal & Waktu Kegiatan" id="kt_datetimepicker_5" autocomplete="off"
                    data-toggle="datetimepicker" data-target="#kt_datetimepicker_5" value="{{ old('tr_waktu_kegiatan') }}"
                    :messages="$errors->get('tr_waktu_kegiatan')">Waktu
                    Kegiatan<x-redstar />
                  </x-validation.inline.txt>

                </div>
                <!--end::Wizard Data-->

                <!--begin::Wizard Actions-->
                <div class="d-flex justify-content-between border-top mt-5 pt-10">
                  <div class="mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4"
                      data-wizard-type="action-prev">Sebelumnya</button>
                  </div>
                  <div>
                    <button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                      data-wizard-type="action-submit">Simpan</button>
                    <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"
                      data-wizard-type="action-next">Selanjutnya</button>
                  </div>
                </div>
                <!--end::Wizard Actions-->
                <div></div>
                <div></div>
              </form>
              <!--end::Wizard Form-->
            </div>
          </div>
        </div>

        {{-- <x-form.submit-group-card route="{{ route('perencanaan.index') }}" /> --}}

      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection
