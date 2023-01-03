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
        <span class="d-none d-md-block">Import Harga Pangan</span>
        <i class="tf-icons bx bx-upload d-block d-md-none"></i>
      </button>
      <a href="{{ url('pangan/harga/export') }}" class="btn btn-sm rounded-pill btn-outline-secondary">
        <span class="d-none d-md-block">Download Format</span>
        <i class="tf-icons bx bx-download d-block d-md-none"></i>
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
            <th>Harga</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($hargapangans as $hargapangan)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $hargapangan->nama }}</td>
            <td>@rupiah($hargapangan->harga)</td>
            <td class="text-center">
              <form method="post" action="{{ url('hargapangan/' . $hargapangan->id) }}"
                onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                @csrf
                @method('delete')
                <a href="{{ url('pangan/harga/' . $hargapangan->id)}}"
                  class="btn rounded-pill btn-info btn-sm text-white">
                  <span class="d-none d-md-block">Detail</span>
                  <i class="tf-icons bx bx-show d-block d-md-none"></i>
                </a>
                <a href="{{ url('hargapangan/' . $hargapangan->id . '/edit') }}"
                  class="btn rounded-pill btn-secondary btn-sm text-white">
                  <span class="d-none d-md-block">Edit</span>
                  <i class="tf-icons bx bxs-edit d-block d-md-none"></i>
                </a>
                <button type="submit" class="btn rounded-pill btn-danger btn-sm text-white">
                  <span class="d-none d-md-block">Hapus</span>
                  <i class="tf-icons bx bx-trash-alt d-block d-md-none"></i>
                </button>
              </form>
            </td>
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