@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
<h4 class="fw-bold py-3 mb-4">Profile Saya</h4>
@if (session('success'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible" user="alert">
  <h5 class="text-danger">Error!</h5>
  <p>
    @foreach (session('error') as $error)
    -&nbsp; {{ $error }} <br>
    @endforeach
  </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card mb-4">
  <h5 class="card-header">Detail Profile</h5>
  <!-- Account -->
  <form action="{{ url('profile') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="d-flex align-items-start align-items-sm-center gap-4">
        @if ($user->foto)
        <img src="{{ asset('storage/uploads/' . $user->foto) }}" alt="{{ $user->nama }}" class="d-block rounded"
          height="100" width="100" id="uploadedAvatar" />
        @else
        <img src="{{ asset('sneat/assets/img/avatars/1.png') }}" alt="{{ $user->nama }}" class="d-block rounded"
          height="100" width="100" id="uploadedAvatar" />
        @endif
        <div class="button-wrapper">
          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
            <span class="d-none d-sm-block">Upload foto baru</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
            <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg"
              name="foto" />
          </label>
          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
            <i class="bx bx-reset d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Reset</span>
          </button>
          <p class="text-muted mb-0">Masukan gambar dengan format jpg atau png.</p>
        </div>
      </div>
    </div>
    <hr class="my-1" />
    <div class="card-body">
      <div class="row">
        <div class="mb-3 col-md-6">
          <div class="form-group">
            <label for="name" class="form-label">Nama</label>
            <input class="form-control" type="text" id="name" name="nama" value="{{ old('nama', $user->nama) }}"
              autofocus />
          </div>
        </div>
        <div class="mb-3 col-md-6">
          <div class="form-group">
            <label class="form-label" for="telp">No. Telepon</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">+62</span>
              <input type="text" id="telp" name="telp" class="form-control" value="{{ old('telp', $user->telp) }}" />
            </div>
          </div>
        </div>
        <div class="mb-3 col-md-6">
          <div class="form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat"
              rows="3">{{ old('alamat', $user->alamat) }}</textarea>
          </div>
        </div>
      </div>
    </div>
    <hr class="my-1" />
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge">
              <input type="password" id="password" class="form-control" name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" value="{{ old('password') }}" />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
            </div>
            <div class="input-group input-group-merge">
              <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" value="{{ old('password_confirmation') }}" />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="my-0" />
    <div class="card-footer text-end">
      <button type="submit" class="btn btn-primary">
        <span class="d-none d-sm-block">Perbarui</span>
        <i class="tf-icons bx bx-send d-block d-sm-none"></i>
      </button>
    </div>
  </form>
  <!-- /Account -->
</div>
@endsection