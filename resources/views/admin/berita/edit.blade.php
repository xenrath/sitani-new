@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('admin/berita') }}">Berita</a> /
  </span> Edit Berita
</h4>
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Berita</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('admin/berita/' . $berita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
      <div class="form-group mb-3">
        <label class="form-label" for="kategoripangan_id">Kategori Pangan *</label>
        <select class="form-select" id="kategoripangan_id" name="kategoripangan_id">
          <option value="">- Pilih -</option>
          @foreach ($kategoripangans as $kategoripangan)
          <option value="{{ $kategoripangan->id }}" {{ old('kategoripangan_id', $berita->kategoripangan_id)==$kategoripangan->id ? 'selected' : null
            }}>{{ $kategoripangan->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="judul">Judul</label>
        <input type="text" class="form-control" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}"
          placeholder="masukan judul berita" />
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="isi">Isi</label>
        <textarea class="form-control" id="isi" rows="3" placeholder="masukan isi berita"
          name="isi">{{ old('isi', $berita->isi) }}</textarea>
      </div>
      <div class="form-group mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input class="form-control" type="file" name="gambar" id="gambar" accept="image/*">
        <small>(kosongkan saja jika tidak ingin mengubah)</small>
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