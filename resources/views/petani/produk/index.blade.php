@extends('layouts.app')

@section('title', 'Produk')

@section('content')
@if (auth()->user()->isAdmin())

@else
<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold pb-2">Produk Saya</h4>
  <a href="{{ url('petani/produk/create') }}" class="btn btn-primary">
    <i class="tf-icons bx bx-plus"></i>
    <span class="d-none d-md-inline">Tambah Produk</span>
  </a>
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
        <a href="{{ url('petani/produk/' . $produk->id . '/edit') }}" class="btn btn-outline-secondary">
          <i class="tf-icons bx bxs-edit"></i>
          <span class="d-none d-md-inline">Ubah Detail</span>
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
@endif
@endsection