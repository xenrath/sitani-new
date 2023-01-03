@extends('layouts.app')

@section('title', 'Kategori Produk')

@section('content')
@if (auth()->check() &&
auth()->user()->isAdmin())
<h4 class="fw-bold py-3 mb-3">Kategori Produk</h4>
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel Kategori
    <a href="{{ url('k_produk/create') }}" class="btn btn-sm rounded-pill btn-primary">
      <span class="d-none d-sm-block">Tambah Kategori</span>
      <i class="tf-icons bx bx-plus d-block d-sm-none"></i>
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
              <form method="post" action="{{ url('k_produk/' . $kategoriproduk->id) }}"
                onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                @csrf
                @method('delete')
                <a href="{{ url('k_produk/' . $kategoriproduk->id) }}"
                  class="btn rounded-pill btn-info btn-sm text-white">
                  <span class="d-none d-sm-block">Detail</span>
                  <i class="tf-icons bx bx-show d-block d-sm-none"></i>
                </a>
                <a href="{{ url('k_produk/' . $kategoriproduk->id . '/edit') }}"
                  class="btn rounded-pill btn-secondary btn-sm text-white">
                  <span class="d-none d-sm-block">Edit</span>
                  <i class="tf-icons bx bxs-edit d-block d-sm-none"></i>
                </a>
                <button type="submit" class="btn rounded-pill btn-danger btn-sm text-white">
                  <span class="d-none d-sm-block">Hapus</span>
                  <i class="tf-icons bx bx-trash d-block d-sm-none"></i>
                </button>
              </form>
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