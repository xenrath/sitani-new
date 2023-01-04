@extends('layouts.app')

@section('title', 'Harga Pangan')

@section('content')
@if (auth()->check() && auth()->user()->isAdmin())
<h4 class="fw-bold py-3 mb-3">Harga Pangan | {{ date('d M Y', strtotime($pangan->created_at)) }}</h4>
@if (session('status'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible" user="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('failures'))
<div class="alert alert-danger alert-dismissible" user="alert">
  <h5 class="text-danger">Error!</h5>
  @foreach (session('failures') as $fail)
  <p>
    <span class="bullet"></span>&nbsp;
    Baris ke {{ $fail->row() }} : <strong>{{ $fail->values()[$fail->attribute()] }}</strong>,
    @foreach ($fail->errors() as $error)
    {{ $error }}
    @endforeach
  </p>
  @endforeach
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel Harga Pangan
    <div>
      <button type="button" class="btn btn-sm rounded-pill btn-outline-primary me-1" data-bs-toggle="modal"
        data-bs-target="#modalImport">
        <i class="tf-icons bx bx-upload"></i>
        <span class="d-none d-md-inline">Import Harga Pangan</span>
      </button>
      <a href="{{ url('pangan/harga/export') }}" class="btn btn-sm rounded-pill btn-outline-secondary">
        <i class="tf-icons bx bx-download"></i>
        <span class="d-none d-md-inline">Download Format</span>
      </a>
    </div>
  </h5>
  <div class="card-body p-0">
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Nama Pangan</th>
            <th>Kategori</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($hargapangans as $key => $hargapangan)
          <tr>
            <td class="text-center">{{ $hargapangans->firstItem() + $key }}</td>
            <td>{{ $hargapangan->nama }}</td>
            <td>{{ $hargapangan->kategoripangan->nama }}</td>
            <td>@rupiah($hargapangan->harga)</td>
          </tr>
          @empty
          <tr></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer">
    <div class="pagination float-end">
      {{ $hargapangans->appends(Request::all())->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>
<div class="modal fade" id="modalImport" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalToggleLabel">Import Harga Pangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ url('pangan/harga/import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <label for="file" class="form-label">File *</label>
          <input type="file" id="file" name="file" class="form-control"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Batal
          </button>
          <button type="submit" class="btn btn-primary">
            Kirim
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endsection