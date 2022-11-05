@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold pb-2">
    <span class="text-muted fw-light">
      <a href="{{ url('produk') }}">Produk</a> /
    </span> Ubah
  </h4>
</div>
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Tambah Produk</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('produk/' . $produk->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
     <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="nama">Nama Produk</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}" placeholder="Masukan nama produk" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="kategori">Kategori</label>
            <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id"
          name="kategori_id">
          <option value="">- Pilih -</option>
          @foreach ($kategoriproduks as $k)
              <option value="{{ $k->id }}"
                  {{ old('kategori_id') == $k->id ? 'selected' : null }}>{{ $k->nama }}</option>
          @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="harga">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" placeholder="Masukan harga produk" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="stok">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" placeholder="Masukan stok produk" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="gambar">Gambar</label>
            <input type="file" class="form-control" name="gambar" value="{{ old('gambar', $produk->gambar) }}id="gambar" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi"  rows="3" placeholder="Masukan isi produk">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
          </div>
        </div>
      </div>
    </div>


    <div class="card-footer float-end">
      <button type="reset" class="btn btn-secondary me-1">
        <span class="d-none d-sm-block">Reset</span>
        <i class="tf-icons bx bx-reset d-block d-sm-none"></i>
        </a>
      </button>
      <button type="submit" class="btn btn-primary">
        <span class="d-none d-sm-block">Kirim</span>
        <i class="tf-icons bx bx-send d-block d-sm-none"></i>
      </button>
    </div>
  </form>
</div>
@endsection