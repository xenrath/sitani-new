@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<h4 class="fw-bold py-3 mb-4">Dashboard</h4>
<div class="row">
  <div class="col-lg-4 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end">
        <div class="card-body">
          <h5 class="card-title text-primary">Data User</h5>
          <p class="mb-4">
            <span class="fw-bold">{{ count($users) }}</span>&nbsp; data
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end">
        <div class="card-body">
          <h5 class="card-title text-primary">Data Berita</h5>
          <p class="mb-4">
            <span class="fw-bold">{{ count($beritas) }}</span>&nbsp; data
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end">
        <div class="card-body">
          <h5 class="card-title text-primary">Kategori Produk</h5>
          <p class="mb-4">
            <span class="fw-bold">{{ count($kategoriproduks) }}</span>&nbsp; data
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end">
        <div class="card-body">
          <h5 class="card-title text-primary">Data Produk</h5>
          <p class="mb-4">
            <span class="fw-bold">{{ count($produks) }}</span>&nbsp; data
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end">
        <div class="card-body">
          <h5 class="card-title text-primary">Kategori Pangan</h5>
          <p class="mb-4">
            <span class="fw-bold">{{ count($kategoripangans) }}</span>&nbsp; data
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end">
        <div class="card-body">
          <h5 class="card-title text-primary">Harga Produk</h5>
          <p class="mb-4">
            <span class="fw-bold">{{ count($hargapangans) }}</span>&nbsp; data
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection