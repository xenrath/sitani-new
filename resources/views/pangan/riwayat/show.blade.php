@extends('layouts.app')

@section('title', 'Detail Riwayat Pangan')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ url('pangan/riwayat') }}">Riwayat Pangan /</a>
  </span> Detail
</h4>
<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Riwayat Pangan</h5>
      </div>
      <hr class="my-1" />
      <div class="card-body p-0">
        <div class="row p-4">
          <label class="col-sm-4">
            <h5>Tanggal Dibuat</h5>
          </label>
          <div class="col-sm-8">
            <p>{{ date('d M Y', strtotime($pangan->created_at)) }}</p>
          </div>
        </div>
        <div class="table-responsive text-nowrap mb-4">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Kategori</th>
                <th>Nama Pangan</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($hargapangans as $hargapangan)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $hargapangan->kategoripangan->nama }}</td>
                <td>{{ $hargapangan->nama }}</td>
                <td>@rupiah($hargapangan->harga)</td>
              </tr>
              @empty
              <tr></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="p-4 float-end">
          <a href="{{ url('pangan/riwayat/' . $pangan->id . '/download') }}" class="btn btn-secondary">
            <i class="tf-icons bx bx-download"></i>
            <span class="d-none d-md-inline">Unduh</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection