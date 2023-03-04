@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold pb-2">
    <span class="text-muted fw-light">
      <a href="{{ url('produk/produk') }}">Produk</a> /
    </span> Ubah
  </h4>
</div>
@if (session('error'))
<div class="alert alert-danger alert-dismissible" user="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('status'))
<div class="alert alert-warning alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Ubah Produk</h5>
    <a href="" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#modalDelete">
      <i class="bx bxs-trash"></i>&nbsp;Hapus
    </a>
  </div>
  <hr class="my-1" />
  <form action="{{ url('produk/produk/' . $produk->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="nama">Nama Produk *</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}"
              placeholder="Masukan nama produk" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="kategori">Kategori *</label>
            <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
              <option value="">- Pilih -</option>
              @foreach ($kategoriproduks as $k)
              <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id)==$k->id ? 'selected' : null }}>{{
                $k->nama }}</option>
              @endforeach
            </select>
            @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="harga">Harga *</label>
            <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}"
              placeholder="Masukan harga produk" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="stok">Stok *</label>
            <input type="number" class="form-control" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}"
              placeholder="Masukan stok produk" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="gambar">Gambar</label>
            <input type="file" class="form-control" name="gambars[]" value="{{ old('gambar', $produk->gambar) }}id="
              gambar" accept="image/*" multiple />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="deskripsi">Deskripsi *</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"
              placeholder="Masukan isi produk">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        @foreach ($gambarproduks as $gambarproduk)
        <div class="col-md-3 col-sm-6">
          <div class="row">
            <div class="col-10">
              <img src="{{ asset('storage/uploads/' . $gambarproduk->gambar) }}" alt="{{ $produk->nama }}"
                class="w-100 rounded">
            </div>
            <div class="col-2">
              <a href="{{ url('hapus-gambar/'. $gambarproduk->id) }}">
                <i class="bx bxs-x-circle bx-sm text-danger"></i>
              </a>
            </div>
          </div>
        </div>
        @endforeach
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
<div class="modal fade" id="modalDelete" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalToggleLabel">Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Yakin hapus Produk <strong>{{ $produk->nama }}</strong>?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Batal
        </button>
        <button type="button" class="btn btn-primary"
          onclick="event.preventDefault(); document.getElementById('delete').submit();">
          Ya
        </button>
        <form action="{{ url('produk/produk/' . $produk->id) }}" method="POST" id="delete">
          @csrf
          @method('delete')
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  var kategori_id = document.getElementById('kategori_id');
  var stok = document.getElementById('stok');
  kategori_id.addEventListener('change', function (){
    if (this.value == '2') {
      stok.value = 1;
      stok.setAttribute('type', 'hidden');
    } else {
      stok.setAttribute('type', 'number');
    }
  })
</script>
@endsection