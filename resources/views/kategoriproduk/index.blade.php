@extends('layouts.app')

@section('title', 'Kategori Produk')

@section('content')
    @if (auth()->check() &&
        auth()->user()->isAdmin())
        <h4 class="fw-bold py-3 mb-4">Kategori Produk</h4>
        <div class="card">
            <h5 class="card-header d-flex align-items-start justify-content-between">
                Tabel Kategori
                <a href="{{ url('kategoriproduk/create') }}" class="btn btn-sm rounded-pill btn-primary">
                    <span class="d-none d-sm-block">Tambah Kategori Produk</span>
                    <i class="tf-icons bx bx-plus d-block d-sm-none"></i>
                </a>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kategoriproduks as $kategoriproduk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategoriproduk->nama }}</td>

                                <td class="text-center">
                                    <form method="post" action="{{ url('kategoriproduk/' . $kategoriproduk->id) }}"
                                        onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                        @csrf
                                        @method('delete')
                                          <a href="{{ route('kategoriproduk.show', $kategoriproduk->id)}}" class="btn rounded-pill btn-info btn-sm text-white">
                                            <span class="tf-icons bx bx-show"></span>&nbsp; Detail
                                            </a>
                                        <a href="{{ url('kategoriproduk/' . $kategoriproduk->id . '/edit') }}" class="btn rounded-pill btn-secondary btn-sm text-white">
                                            <span class="d-none d-sm-block">Edit</span>
                                            <i class="tf-icons bx bxs-edit d-block d-sm-none"></i>
                                        </a>
                                        <button type="submit" class="btn rounded-pill btn-danger btn-sm text-white">
                                         <span class="d-none d-sm-block"></span>&nbsp; Hapus
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kategoriproduks->appends(Request::all())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
@endsection
