@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold pb-2">
    <span class="text-muted fw-light">Produk /</span>
    <span id="span_kategori">
      @if ($kategoriproduk)
      {{ $kategoriproduk->nama }}
      @else
      Semua Produk
      @endif
    </span>
  </h4>
  <form action="{{ url('tengkulak/produk') }}" method="get" id="form_kategori">
    <div class="input-group input-group-merge">
      <span class="input-group-text" id="keyword">
        <i class="bx bx-search"></i>
      </span>
      <input type="text" id="keyword" name="keyword" class="form-control" placeholder="cari produk..."
        aria-label="cari..." aria-describedby="keyword" value="{{ Request::get('keyword') }}" onsubmit="event.preventDefault();
        document.getElementById('form_kategori').submit();" />
    </div>
    <input type="hidden" class="form-control" id="kategori_id" name="kategori_id">
  </form>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="bx bx-menu"></i>&nbsp;
      <span class="d-none d-md-inline">
        @if ($kategoriproduk)
        {{ $kategoriproduk->nama }}
        @else
        Semua Produk
        @endif
      </span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" onclick="getKategori('')">Semua
          Produk</button>
      </li>
      @foreach ($kategoriproduks as $kategoriproduk)
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center"
          onclick='getKategori("{{ $kategoriproduk->id }}", "{{ $kategoriproduk->nama }}")'>{{ $kategoriproduk->nama
          }}</button>
      </li>
      @endforeach
    </ul>
  </div>
</div>
@if (session('status'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (count($produks) > 0)
<div class="row row-cols-2 row-cols-md-4 g-4">
  @foreach ($produks as $produk)
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('storage/uploads/' . $produk->gambar->first()->gambar) }}"
        alt="{{ $produk->nama }}" height="200px" style="object-position: center; object-fit: none;" />
      <div class="card-body">
        <h5 class="card-title">
          {{ $produk->nama }}
          <span class="badge bg-label-primary">{{ $produk->kategori->nama }}</span>
        </h5>
        <p class="card-text">
          {{ $produk->deskripsi }}
        </p>
        <a href="{{ url('tengkulak/produk/' . $produk->id) }}" class="btn btn-outline-primary">
          <i class="tf-icons bx bx-show"></i>
          <span class="d-none d-md-inline">Lihat Detail</span>
        </a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@else
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body text-center">- Produk tidak ditemukan -</div>
    </div>
  </div>
</div>
@endif
<script>
  function getKategori(id, nama) {
    var span_kategori = document.getElementById('span_kategori');
    var form_kategori = document.getElementById('form_kategori');
    var kategori_id = document.getElementById('kategori_id');
    span_kategori.textContent = nama;
    kategori_id.value = id;
    form_kategori.submit();
  }
</script>
@endsection