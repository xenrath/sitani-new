@extends('layouts.app')

@section('title', 'Tambah Kategori harga')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">
        <a href="{{ url('kategoriharga') }}">Kategori Harga</a> /
    </span> Tambah
</h4>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tambah Kategori Harga</h5>
    </div>
    <hr class="my-1" />
    <form action="{{ url('kategoriharga') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group mb-3">
                <label class="form-label" for="judul">Kategori</label>
                <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Masukan kategori" required />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan nama" required />
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
