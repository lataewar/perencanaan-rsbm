@props(['route'])

<div class="d-flex justify-content-between border-top mt-5 pt-10">
  <div class="mr-2"></div>
  <div>
    <a href="{{ $route }}" class="btn btn-danger font-weight-bolder text-uppercase px-9 py-4 mr-2">Batal</a>
    <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4">Simpan</button>
  </div>
</div>
