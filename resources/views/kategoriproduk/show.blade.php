@extends('layouts.app')

@section('title', 'Detail Kategori Produk')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('kategoriproduk') }}">Kategori Produk</a>
  </span> Detail
</h4>
<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Kategori Produk </h5>
      </div>
      <hr class="my-1" />
      <div class="card-body">
        <div class="row mb-2">
          <label class="col-sm-4">
            <h5>Nama Produk</h5>
          </label>
          <div class="col-sm-8">
            <p>{{ $kategoriproduk->nama }}</p>
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-sm-4"></label>
          <div class="col-sm-8">
            <p>
              <small class="text-muted">Last updated 3 mins ago</small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection