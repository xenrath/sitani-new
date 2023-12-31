@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('petani/berita') }}">Berita</a> /
  </span> Detail Berita
</h4>
<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Berita</h5>
      </div>
      <hr class="my-1" />
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <img src="{{ asset('storage/uploads/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
              class="w-100 rounded">
          </div>
          <div class="col-8">
            <div class="row mb-2">
              <label class="col-sm-4">
                <h5>Judul Berita</h5>
              </label>
              <div class="col-sm-8">
                <p>{{ $berita->judul }}</p>
              </div>
            </div>
            <div class="row mb-2">
              <label class="col-sm-4">
                <h5>Isi</h5>
              </label>
              <div class="col-sm-8">
                <p>{{ $berita->isi }}</p>
              </div>
            </div>
            <div class="row mb-2">
              <label class="col-sm-4">
                <h5>Tanggal</h5>
              </label>
              <div class="col-sm-8">
                <p>{{ date('d M Y', strtotime($berita->created_at)) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection