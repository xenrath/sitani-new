@extends('layouts.app')

@section('title', 'Kategori Harga')

@section('content')
@if (auth()->check() &&
auth()->user()->isAdmin())
<h4 class="fw-bold py-3 mb-4">Kategori Pangan</h4>
@if (session('status'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel Kategori Pangan
    <a href="{{ url('admin/kategori-pangan/create') }}" class="btn btn-sm rounded-pill btn-primary">
      <i class="tf-icons bx bx-plus"></i>
      <span class="d-none d-md-inline">Tambah Kategori</span>
    </a>
  </h5>
  <div class="card-body p-0">
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($kategoripangans as $key => $kategoripangan)
          <tr>
            <td class="text-center">{{ $kategoripangans->firstItem() + $key }}</td>
            <td>{{ $kategoripangan->kategori }}</td>
            <td>{{ $kategoripangan->nama }}</td>
            <td class="text-center">
              <a href="{{ url('admin/kategori-pangan/' . $kategoripangan->id . '/edit') }}"
                class="btn rounded-pill btn-secondary btn-sm text-white">
                <i class="tf-icons bx bxs-edit"></i>
                <span class="d-none d-md-inline">Edit</span>
              </a>
              <button type="button" class="btn rounded-pill btn-danger btn-sm text-white" data-bs-toggle="modal"
                data-bs-target="#modalDelete{{ $kategoripangan->id }}">
                <i class="tf-icons bx bx-trash"></i>
                <span class="d-none d-md-inline">Hapus</span>
              </button>
            </td>
            <div class="modal fade" id="modalDelete{{ $kategoripangan->id }}" aria-labelledby="modalToggleLabel" tabindex="-1"
              style="display: none" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">Yakin hapus kategori pangan
                    <strong>{{ $kategoripangan->nama }}</strong>?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Batal
                    </button>
                    <button type="button" class="btn btn-primary"
                      onclick="event.preventDefault(); document.getElementById('delete{{ $kategoripangan->id }}').submit();">
                      Ya
                    </button>
                    <form action="{{ url('admin/kategori-pangan/' . $kategoripangan->id) }}" method="POST" id="delete{{ $kategoripangan->id }}">
                      @csrf
                      @method('delete')
                    </form>
                  </div>
                </div>
              </div>
            </div>
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
      {{ $kategoripangans->appends(Request::all())->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>
@endif
@endsection