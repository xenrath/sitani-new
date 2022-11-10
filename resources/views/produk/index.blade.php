@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="d-flex align-items-start justify-content-between py-3">
  @if (auth()->user()->isPetani())
  <h4 class="fw-bold pb-2">Produk Saya</h4>
  <a href="{{ url('produk/create') }}" class="btn btn-primary">
    <span class="d-none d-sm-block">Tambah Produk</span>
    <i class="tf-icons bx bx-plus d-block d-sm-none"></i>
  </a>
  @else
  <h4 class="fw-bold pb-2">
    <span class="text-muted fw-light">Produk /</span>
    <span id="kategori">Semua</span>
  </h4>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="bx bx-menu"></i>&nbsp;
      <span class="d-none d-md-inline">Kategori Produk</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a href="" class="dropdown-item d-flex align-items-center">Semua Produk</a>
      </li>
      <li>
        <a href="" class="dropdown-item d-flex align-items-center">Produk Biasa</a>
      </li>
      <li>
        <a href="" class="dropdown-item d-flex align-items-center">Produk Tebasan</a>
      </li>
    </ul>
  </div>
  @endif
</div>
@if (session('status'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row row-cols-2 row-cols-md-4 g-4">
  @foreach ($produks as $produk)
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('storage/uploads/' . $produk->gambar->first()->gambar) }}"
        alt="{{ $produk->nama }}" height="200px" style="object-position: center; object-fit: none;"/>
      <div class="card-body">
        <h5 class="card-title">{{ $produk->nama }}</h5>
        <p class="card-text">
          {{ $produk->deskripsi }}
        </p>
        @if (auth()->user()->isPetani())
        <a href="{{ url('produk/' . $produk->id . '/edit') }}" class="btn btn-outline-secondary">Ubah Detail</a>
        @else
        <a href="{{ url('produk/' . $produk->id . '1') }}" class="btn btn-outline-primary">Lihat Detail</a>
        @endif
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection