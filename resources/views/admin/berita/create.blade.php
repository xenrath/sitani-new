@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('berita') }}">Berita</a> /
  </span> Tambah
</h4>
@if (session('status'))
<div class="alert alert-danger alert-dismissible" user="alert">
  <h5 class="text-danger">Error!</h5>
  <p>
    @foreach (session('status') as $error)
    -&nbsp; {{ $error }} <br>
    @endforeach
  </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Tambah Berita</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('berita') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group mb-3">
        <label class="form-label" for="kategoripangan_id">Kategori Pangan *</label>
        <select class="form-select" id="kategoripangan_id" name="kategoripangan_id">
          <option value="">- Pilih -</option>
          @foreach ($kategoripangans as $kategoripangan)
          <option value="{{ $kategoripangan->id }}" {{ old('kategoripangan_id')==$kategoripangan->id ? 'selected' : null
            }}>{{ $kategoripangan->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="judul">Judul *</label>
        <input type="text" class="form-control" name="judul" id="judul" placeholder="masukan judul berita" />
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="isi">Isi *</label>
        <textarea class="form-control" id="isi" rows="3" placeholder="masukan isi berita"
          name="isi">{{ old('isi') }}</textarea>
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="gambar">Gambar *</label>
        <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" />
      </div>
    </div>
    <div class="card-footer float-end">
      <button type="reset" class="btn btn-secondary me-1">
        <span class="tf-icons bx bx-reset"></span>&nbsp; Reset</a>
      </button>
      <button type="submit" class="btn btn-primary">
        <span class="tf-icons bx bx-send"></span>&nbsp; Kirim</a>
      </button>
    </div>
  </form>
</div>
@endsection