@extends('layouts.app')

@section('title', 'User')

@section('content')
<h4 class="fw-bold py-3 mb-4">Data User</h4>
@if (session('status'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel User
    <a href="{{ url('admin/user/create') }}" class="btn btn-sm rounded-pill btn-primary">
      <i class="tf-icons bx bx-plus"></i>
      <span class="d-none d-md-inline">Tambah User</span>
    </a>
  </h5>
  <div class="card-body p-0">
    <div class="px-4 pb-4" style="width: 320px">
      <form method="get" action="{{ url('admin/user') }}">
        <div class="input-group">
          <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="keyword"
            value="{{ Request::get('keyword') }}">
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submit">
              <i class="bx bx-search-alt-2"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Nama</th>
            <th>No Telepon</th>
            <th>Role</th>
            <th class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($users as $key => $user)
          <tr>
            <td class="text-center">{{ $users->firstItem() + $key }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->telp }}</td>
            <td>{{ $user->role }}</td>
            <td class="text-center">
              <a href="{{ url('admin/user/' . $user->id) }}" class="btn rounded-pill btn-info btn-sm text-white">
                <i class="tf-icons bx bx-show"></i>
                <span class="d-none d-md-inline">Detail</span>
              </a>
              <a href="{{ url('admin/user/' . $user->id . '/edit') }}"
                class="btn rounded-pill btn-secondary btn-sm text-white">
                <i class="tf-icons bx bxs-edit"></i>
                <span class="d-none d-md-inline">Edit</span>
              </a>
              <a href="" class="btn rounded-pill btn-danger btn-sm text-white" data-bs-toggle="modal"
                data-bs-target="#modalDelete{{ $user->id }}">
                <i class="tf-icons bx bx-trash-alt"></i>
                <span class="d-none d-md-inline">Hapus</span>
              </a>
              <div class="modal fade" id="modalDelete{{ $user->id }}" aria-labelledby="modalToggleLabel" tabindex="-1"
                style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalToggleLabel">Hapus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Yakin hapus User
                      <strong>{{ $user->nama }}</strong>?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                      </button>
                      <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('delete{{ $user->id }}').submit();">
                        Ya
                      </button>
                      <form action="{{ url('admin/user/' . $user->id) }}" method="POST" id="delete{{ $user->id }}">
                        @csrf
                        @method('delete')
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer">
    <div class="pagination float-end">
      {{ $users->appends(Request::all())->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>
@endsection