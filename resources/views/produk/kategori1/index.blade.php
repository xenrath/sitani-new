@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="d-flex align-items-start justify-content-between py-3 mb-3">
  <h4 class="fw-bold">
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
</div>
<div class="row row-cols-2 row-cols-md-4 g-4">
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('sneat/assets/img/elements/2.jpg') }}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Nama Produk</h5>
        <p class="card-text">
          Deskripsi
        </p>
        <a href="{{ url('produk/1') }}" class="btn btn-outline-primary">Lihat Detail</a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('sneat/assets/img/elements/13.jpg') }}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Nama Produk</h5>
        <p class="card-text">
          Deskripsi
        </p>
        <a href="" class="btn btn-outline-primary">Lihat Detail</a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('sneat/assets/img/elements/4.jpg') }}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Nama Produk</h5>
        <p class="card-text">
          Deskripsi
        </p>
        <a href="" class="btn btn-outline-primary">Lihat Detail</a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('sneat/assets/img/elements/18.jpg') }}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Nama Produk</h5>
        <p class="card-text">
          Deskripsi
        </p>
        <a href="" class="btn btn-outline-primary">Lihat Detail</a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('sneat/assets/img/elements/19.jpg') }}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a longer card with supporting text below as a natural lead-in to additional content.
          This content is a little bit longer.
        </p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{ asset('sneat/assets/img/elements/20.jpg') }}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Nama Produk</h5>
        <p class="card-text">
          Deskripsi
        </p>
        <a href="" class="btn btn-outline-primary">Lihat Detail</a>
      </div>
    </div>
  </div>
</div>
@endsection