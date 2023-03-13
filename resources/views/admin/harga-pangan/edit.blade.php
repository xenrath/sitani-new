@extends('layouts.app')

@section('title', 'Edit Harga Pangan')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('admin/hargapangan') }}">Harga Pangan</a> /
  </span> Edit
</h4>
@if (session('error'))
<div class="alert alert-danger alert-dismissible" user="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Harga Pangan</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('admin/hargapangan/' . $hargapangan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
      <div class="form-group mb-3">
        <label class="form-label" for="kategori_id">Kategori</label>
        <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
          <option value="">- Pilih -</option>
          @foreach ($kategorihargas as $kategoriharga)
          <option value="{{ $kategoriharga->id }}" {{ old('kategori_id', $hargapangan->kategori_id)==$kategoriharga->id
            ? 'selected' : null
            }}>{{ $kategoriharga->kategori }}</option>
          @endforeach
        </select>
        @error('kategori_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="namapangan">Nama Pangan</label>
        <input type="text" class="form-control" name="namapangan" id="namapangan"
          value="{{ old('namapangan', $hargapangan->namapangan) }}" placeholder="Masukan harga" required />
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="harga">Harga</label>
        <input type="number" class="form-control" name="harga" id="harga"
          value="{{ old('harga', $hargapangan->harga) }}" placeholder="Masukan harga" required />
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