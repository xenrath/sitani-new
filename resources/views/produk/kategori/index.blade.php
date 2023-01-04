@extends('layouts.app')

@section('title', 'Kategori Produk')

@section('content')
@if (auth()->check() &&
auth()->user()->isAdmin())
<h4 class="fw-bold py-3 mb-3">Kategori Produk</h4>
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel Kategori
    <a href="{{ url('produk/kategori/create') }}" class="btn btn-sm rounded-pill btn-primary">
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
            <th>Nama</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($kategoriproduks as $key => $kategoriproduk)
          <tr>
            <td class="text-center">{{ $kategoriproduks->firstItem() + $key }}</td>
            <td>{{ $kategoriproduk->nama }}</td>
            <td class="text-center">
              <a href="{{ url('produk/kategori/' . $kategoriproduk->id . '/edit') }}"
                class="btn rounded-pill btn-secondary btn-sm text-white">
                <i class="tf-icons bx bxs-edit"></i>
                <span class="d-none d-md-inline">Edit</span>
              </a>
              <a href="" class="btn rounded-pill btn-danger btn-sm text-white" data-bs-toggle="modal"
                data-bs-target="#modalDelete{{ $kategoriproduk->id }}">
                <i class="tf-icons bx bx-trash-alt"></i>
                <span class="d-none d-md-inline">Hapus</span>
              </a>
              <div class="modal fade" id="modalDelete{{ $kategoriproduk->id }}" aria-labelledby="modalToggleLabel"
                tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalToggleLabel">Hapus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Yakin hapus Kategori Produk
                      <strong>{{ $kategoriproduk->nama }}</strong>?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                      </button>
                      <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('delete{{ $kategoriproduk->id }}').submit();">
                        Ya
                      </button>
                      <form action="{{ url('produk/kategori/' . $kategoriproduk->id) }}" method="POST"
                        id="delete{{ $kategoriproduk->id }}">
                        @csrf
                        @method('delete')
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="3">- Data tidak ditemukan -</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer">
    <div class="pagination pagination-md float-end">
      {{ $kategoriproduks->appends(Request::all())->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>
@endif
@endsection