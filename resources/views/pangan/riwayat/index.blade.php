@extends('layouts.app')

@section('title', 'Riwayat Pangan')

@section('content')
@if (auth()->check() &&
auth()->user()->isAdmin())
<h4 class="fw-bold py-3 mb-4">Riwayat Pangan</h4>
@if (session('status'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel Riwayat Pangan
  </h5>
  <div class="card-body p-0">
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Tanggal</th>
            <th>Detail</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($pangans as $key => $pangan)
          <tr>
            <td class="text-center">{{ $pangans->firstItem() + $key }}</td>
            <td>{{ date('d M Y', strtotime($pangan->created_at)) }}</td>
            <td>
              <a href="{{ url('pangan/riwayat/' . $pangan->id) }}" class="btn rounded-pill btn-info btn-sm text-white">
                <span class="d-none d-md-block">Lihat</span>
                <i class="tf-icons bx bxs-show d-block d-md-none"></i>
              </a>
            </td>
            <td>
              <a href="{{ url('pangan/riwayat/' . $pangan->id) }}" class="btn rounded-pill btn-outline-secondary btn-sm">
                <span class="d-none d-md-block">Unduh</span>
                <i class="tf-icons bx bxs-download d-block d-md-none"></i>
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="4">- Data tidak ditemukan -</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer">
    <div class="pagination pagination-md float-end">
      {{ $pangans->appends(Request::all())->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>
@endif
@endsection