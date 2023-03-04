@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('admin/user') }}">User</a> /
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
    <h5 class="mb-0">Tambah User</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('admin/user') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group mb-3">
        <label class="form-label" for="role">Role *</label>
        <select class="form-select" id="role" name="role">
          <option value="">- Pilih -</option>
          <option value="admin" {{ old('role')=='admin' ? 'selected' : null }}>Admin</option>
          <option value="petani" {{ old('role')=='petani' ? 'selected' : null }}>Petani</option>
          <option value="tengkulak" {{ old('role')=='tengkulak' ? 'selected' : null }}>Tengkulak</option>
        </select>
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="nama">Nama Lengkap *</label>
        <input type="text" class="form-control" name="nama" id="nama" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" placeholder="Masukan nama"
          value="{{ old('nama') }}" />
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="telp">No. Telepon *</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text">+62</span>
          <input type="text" id="telp" name="telp" class="form-control"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
            value="{{ old('telp') }}" />
        </div>
      </div>
      <div class="form-group mb-3">
        <label for="alamat" class="form-label">Alamat *</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="foto">Foto *</label>
        <input type="file" class="form-control" name="foto" id="foto" accept="image/*" />
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