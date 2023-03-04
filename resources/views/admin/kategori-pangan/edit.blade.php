@extends('layouts.app')

@section('title', 'Ubah Kategori Pangan')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('admin/kategori-pangan') }}">Kategori Pangan</a> /
  </span> Ubah
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
    <h5 class="mb-0">Ubah Kategori Harga</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('admin/kategori-pangan/' . $kategoripangan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
      <div class="form-group mb-3">
        <label class="form-label" for="kategori">Kategori Pangan</label>
        <input type="text" class="form-control" name="kategori" id="kategori"
          value="{{ old('kategori', $kategoripangan->kategori) }}" />
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="nama">Nama Pangan</label>
        <input type="text" class="form-control" name="nama" id="nama"
          value="{{ old('nama', $kategoripangan->nama) }}" />
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