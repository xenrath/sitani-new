@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold pb-2">
    <span class="text-muted fw-light">
      <a href="{{ url('petani/produk') }}">Produk</a> /
    </span> Tambah
  </h4>
</div>
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
    <h5 class="mb-0">Tambah Produk</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('petani/produk') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="nama">Nama Produk *</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}"
              placeholder="masukan nama produk" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="kategori">Kategori *</label>
            <select class="form-select" id="kategori_id" name="kategori_id">
              <option value="">- Pilih -</option>
              @foreach ($kategoriproduks as $k)
              <option value="{{ $k->id }}" {{ old('kategori_id')==$k->id ? 'selected' : null }}>{{ $k->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="harga">Harga *</label>
            <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga') }}"
              placeholder="masukan harga"
              oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" />
          </div>
        </div>
        <div class="col-md-6" id="layout_stok">
          <div class="form-group mb-3">
            <label class="form-label" for="stok">Stok *</label>
            <input type="number" class="form-control" name="stok" value="{{ old('stok') }}" id="stok"
              placeholder="masukan stok"
              oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="deskripsi">Isi *</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"
              placeholder="masukan deskripsi  ">{{ old('deskripsi') }}</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="gambar">Gambar *</label>
            <input type="file" class="form-control" name="gambar[]" id="gambar" accept="image/*" multiple />
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer float-end">
      <button type="reset" class="btn btn-secondary me-1">
        <i class="tf-icons bx bx-reset"></i>
        <span class="d-none d-md-inline">Reset</span>
        </a>
      </button>
      <button type="submit" class="btn btn-primary">
        <i class="tf-icons bx bx-send"></i>
        <span class="d-none d-md-inline">Kirim</span>
      </button>
    </div>
  </form>
</div>
<script>
  var kategori_id = document.getElementById('kategori_id');
  var layout_stok = document.getElementById('layout_stok');
  var stok = document.getElementById('stok');
  kategori_id.addEventListener('change', function (){
    if (this.value == '2') {
      stok.value = 1;
      layout_stok.style.display = 'none';
    } else {
      stok.value = '';
      layout_stok.style.display = 'inline';
    }
  })
</script>
@endsection