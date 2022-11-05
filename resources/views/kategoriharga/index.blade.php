@extends('layouts.app')

@section('title', 'Kategori Harga')

@section('content')
    @if (auth()->check() &&
        auth()->user()->isAdmin())
        <h4 class="fw-bold py-3 mb-4">Kategori Harga</h4>
        <div class="card">
            <h5 class="card-header d-flex align-items-start justify-content-between">
                Tabel Kategori Harga
                <a href="{{ url('kategoriharga/create') }}" class="btn btn-sm rounded-pill btn-primary">
                    <span class="d-none d-sm-block">Tambah Kategori Harga</span>
                    <i class="tf-icons bx bx-plus d-block d-sm-none"></i>
                </a>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kategorihargas as $kategoriharga)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategoriharga->kategori }}</td>
                                <td>{{ $kategoriharga->nama }}</td>

                                <td class="text-center">
                                    <form method="post" action="{{ url('kategoriharga/' . $kategoriharga->id) }}"
                                        onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                        @csrf
                                        @method('delete')
                                          <a href="{{ route('kategoriharga.show', $kategoriharga->id)}}" class="btn rounded-pill btn-info btn-sm text-white">
                                            <span class="tf-icons bx bx-show"></span>&nbsp; Detail
                                            </a>
                                        <a href="{{ url('kategoriharga/' . $kategoriharga->id . '/edit') }}" class="btn rounded-pill btn-secondary btn-sm text-white">
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
                {{ $kategorihargas->appends(Request::all())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
@endsection
