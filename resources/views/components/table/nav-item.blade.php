@props([
    'icon' => 'la la-trash',
    'item' => null,
    'route',
    'name',
    'belanja' => null,
    'barang' => null,
    'namabarang' => null,
    'usulan' => null,
])

@php
  $onclick = '';
  if ($item) {
      $action = $item->id . "', 'Perencanaan " . $item->u_name . ' Tahun ' . $item->p_tahun;
      $onclick = match ($name) {
          'Terima' => "accept('$action')",
          'Tolak' => "reject('$action')",
          'Kirim' => "send('$action')",
          'Hapus' => "destroy_item('$action')",
      };
  } elseif ($belanja && $barang) {
      $onclick = "destroy_pivot('$belanja','$barang','$namabarang','$usulan')";
  }
@endphp

<li class="navi-item">
  <a href="{{ $route }}" onclick="{{ $onclick }}" class="navi-link">
    <span class="navi-icon"><i class="{{ $icon }}"></i></span>
    <span class="navi-text">{{ $name }}</span>
  </a>
</li>
