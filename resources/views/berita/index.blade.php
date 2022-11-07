@extends('layouts.app')

@section('title', 'Berita')

@section('content')
    @if (auth()->check() &&
        auth()->user()->isAdmin())
        <h4 class="fw-bold py-3 mb-4">Berita</h4>
        <div class="card">
            <h5 class="card-header d-flex align-items-start justify-content-between">
                Tabel Berita
                <a href="{{ url('berita/create') }}" class="btn btn-sm rounded-pill btn-primary">
                    <span class="d-none d-sm-block">Tambah Berita</span>
                    <i class="tf-icons bx bx-plus d-block d-sm-none"></i>
                </a>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            {{--  <th>Isi</th>  --}}
                            <th>Tanggal</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($beritas as $berita)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $berita->judul }}</td>
                                {{--  <td>{{ $berita->isi }}</td>  --}}
                                <td>{{ $berita->date }}</td>

                                <td class="text-center">
                                    <form method="post" action="{{ url('berita/' . $berita->id) }}"
                                        onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                        @csrf
                                        @method('delete')
                                         <a href="{{ route('berita.show', $berita->id)}}" class="btn rounded-pill btn-info btn-sm text-white">
                                            <span class="tf-icons bx bx-show"></span>&nbsp; Detail
                                            </a>
                                       <a href="{{ url('berita/' . $berita->id . '/edit') }}" class="btn rounded-pill btn-secondary btn-sm text-white">
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
                {{ $beritas->appends(Request::all())->links('pagination::bootstrap-4') }}

@if (auth()->check() && auth()->user()->isAdmin())
<h4 class="fw-bold py-3 mb-4">Berita</h4>
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel Berita
    <a href="{{ url('berita/create') }}" class="btn btn-sm rounded-pill btn-primary">
      <span class="d-none d-sm-block">Tambah Berita</span>
      <i class="tf-icons bx bx-plus d-block d-sm-none"></i>
    </a>
  </h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th>Judul</th>
          <th>Isi</th>
          <th>Tanggal</th>
          <th class="text-center">Opsi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td class="text-center">1</td>
          <td>Judul</td>
          <td class="text-wrap">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis cum consectetur
            illum unde
            accusantium, aut commodi sunt quae facere et?</td>
          <td>12/02/2022</td>
          <td class="text-center">
            <a href="{{ url('berita/1') }}" class="btn rounded-pill btn-info btn-sm text-white">
              <span class="d-none d-sm-block">Detail</span>
              <i class="tf-icons bx bx-show d-block d-sm-none"></i>
            </a>
            <a href="" class="btn rounded-pill btn-secondary btn-sm text-white">
              <span class="d-none d-sm-block">Edit</span>
              <i class="tf-icons bx bxs-edit d-block d-sm-none"></i>
            </a>
            <a href="" class="btn rounded-pill btn-danger btn-sm text-white" data-bs-toggle="modal"
              data-bs-target="#modalDelete">
              <span class="d-none d-sm-block">Hapus</span>
              <i class="tf-icons bx bx-trash-alt d-block d-sm-none"></i>
            </a>
          </td>
        </tr>
        <div class="modal fade" id="modalDelete" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">Yakin hapus Berita <strong>Judul</strong>?</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Batal
                </button>
                <button type="button" class="btn btn-primary"
                  onclick="event.preventDefault(); document.getElementById('delete').submit();">
                  Ya
                </button>
                <form action="" method="POST" id="delete">
                  @csrf
                  @method('delete')
                </form>
              </div>
            </div>
          </div>
        </div>
      </tbody>
    </table>
  </div>
</div>
@else
<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold pb-2">
    <span class="text-muted fw-light">Berita /</span>
    <span id="kategori">Semua</span>
  </h4>
</div>
<div class="row">
  <div class="col-12 col-md-4 mb-3">
    <div class="list-group">
      <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
        href="#semua">Semua Berita</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list"
        href="#beras">Beras</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list"
        href="#cabai">Cabai</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list"
        href="#jagung">Jagung</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list"
        href="#padi">Padi</a>
    </div>
  </div>
  <div class="col-12 col-md-8">
    <div class="tab-content p-0">
      <div class="tab-pane fade show active" id="semua">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Semua Berita</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a natural lead-in to additional content.
                  This content is a little bit longer.
                </p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Semua Berita</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a natural lead-in to additional content.
                  This content is a little bit longer.
                </p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="beras">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Berita Beras</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a natural lead-in to additional content.
                  This content is a little bit longer.
                </p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="cabai">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Berita Cabai</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a natural lead-in to additional content.
                  This content is a little bit longer.
                </p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="jagung">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Berita Jagung</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a natural lead-in to additional content.
                  This content is a little bit longer.
                </p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="padi">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Berita Padi</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a natural lead-in to additional content.
                  This content is a little bit longer.
                </p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
        </div>
    @endif
@endsection
