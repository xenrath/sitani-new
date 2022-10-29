@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
<h4 class="fw-bold py-3 mb-4">Profile Saya</h4>
<div class="card mb-4">
  <h5 class="card-header">Detail Profile</h5>
  <!-- Account -->
  <div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
      <img src="{{ asset('sneat/assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded" height="100"
        width="100" id="uploadedAvatar" />
      <div class="button-wrapper">
        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
          <span class="d-none d-sm-block">Upload foto baru</span>
          <i class="bx bx-upload d-block d-sm-none"></i>
          <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
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
    <form id="formAccountSettings" method="POST" onsubmit="return false">
      <div class="row">
        <div class="mb-3 col-md-6">
          <div class="form-group">
            <label for="name" class="form-label">Nama</label>
            <input class="form-control" type="text" id="name" name="name" value="" autofocus />
          </div>
        </div>
        <div class="mb-3 col-md-6">
          <div class="form-group">
            <label class="form-label" for="phone">No. Telepon</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">+62</span>
              <input type="text" id="phone" name="phone" class="form-control" value="" />
            </div>
          </div>
        </div>
        <div class="mb-3 col-md-6">
          <div class="form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3"></textarea>
          </div>
        </div>
      </div>
    </form>
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
              aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3 form-password-toggle">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Ulangi Password</label>
          </div>
          <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" name="password"
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              aria-describedby="password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
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
  <!-- /Account -->
</div>
@endsection