@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('user') }}">User</a> /
  </span> Edit
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
    <h5 class="mb-0">Edit User</h5>
  </div>
  <hr class="my-1" />
  <form action="{{ url('user/' . $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
      <div class="form-group mb-3">
        <label class="form-label" for="role">Role *</label>
        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
          <option value="">- Pilih -</option>
          <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : null }}>Admin</option>
          <option value="petani" {{ old('role', $user->role)=='petani' ? 'selected' : null }}>Petani</option>
          <option value="tengkulak" {{ old('role', $user->role)=='tengkulak' ? 'selected' : null }}>Tengkulak</option>
        </select>
        @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="nama">Nama Lengkap *</label>
        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $user->nama) }}"
          placeholder="masukan nama lengkap" />
      </div>
      <div class="form-group mb-3">
        <label class="form-label" for="telp">No. Telepon *</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text">+62</span>
          <input type="text" id="telp" name="telp" class="form-control" value="{{ old('telp', $user->telp) }}" />
        </div>
      </div>
      <div class="form-group mb-3">
        <label for="alamat" class="form-label">Alamat *</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
      </div>
      <div class="form-group mb-3">
        <label for="foto" class="form-label">
          Foto
          @if ($user->foto)
          (opsional)
          @else
          *
          @endif
        </label>
        <input class="form-control" type="file" value="{{ old('foto', $user->foto) }}" name="foto" id="foto">
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