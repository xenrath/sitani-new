@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold">
    <span class="text-muted fw-light">
      <a href="{{ url('produk/produk') }}">Produk /</a>
    </span>
    <span id="kategori">Detail</span>
  </h4>
</div>
<div class="card mb-3 p-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img class="card-img card-img-left rounded" src="{{ asset('storage/uploads/' . $produk->gambar->first()->gambar) }}"
        alt="{{ $produk->nama }}" />
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ $produk->nama }}</h5>
        <p class="card-text">
          {{ $produk->deskripsi }}
        </p>
        <p class="card-text">
          <small class="text-muted">{{ $produk->kategoriproduk->nama }}</small>
        </p>
        <p class="fw-bold">
          @rupiah($produk->harga)
        </p>
        <a href="https://web.whatsapp.com/send?phone=+62{{ $produk->user->telp }}" class="btn rounded-pill mt-4" style="background-color: #25D366; color: white;">
          <i class="bx bxl-whatsapp"></i>
          <span class="align-middle">Hubungi Penjual</span>
        </a>
      </div>
    </div>
  </div>
</div>
{{-- <div class="row row-cols-2 row-cols-md-4 g-4">
  <div class="col">

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
</div> --}}
@endsection