@extends('layouts.app')

@section('title', 'Berita')

@section('content')
@if (auth()->check() && auth()->user()->isAdmin())
<h4 class="fw-bold py-3 mb-4">Berita</h4>
@if (session('status'))
<div class="alert alert-primary alert-dismissible" user="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
  <h5 class="card-header d-flex align-items-start justify-content-between">
    Tabel Berita
    <a href="{{ url('berita/create') }}" class="btn btn-sm rounded-pill btn-primary">
      <span class="d-none d-sm-block">Tambah Berita</span>
      <i class="tf-icons bx bx-plus d-block d-sm-none"></i>
    </a>
  </h5>
  <div class="card-body p-0">
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
          @forelse ($beritas as $key => $berita)
          <tr>
            <td class="text-center align-top">{{ $beritas->firstItem() + $key }}</td>
            <td class="text-wrap align-top">{{ $berita->judul }}</td>
            <td class="text-wrap align-top">{{ $berita->isi }}</td>
            <td class="align-top">{{ date('d-m-Y', strtotime($berita->date)) }}</td>
            <td class="text-center align-top">
              <a href="{{ url('berita/' . $berita->id) }}" class="btn rounded-pill btn-info btn-sm text-white">
                <span class="d-none d-sm-block">Detail</span>
                <i class="tf-icons bx bx-show d-block d-sm-none"></i>
              </a>
              <a href="{{ url('berita/' . $berita->id . '/edit') }}"
                class="btn rounded-pill btn-secondary btn-sm text-white">
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
          @empty
          <tr>
            <td class="text-center" colspan="5">- Data tidak ditemukan -</td>
          </tr>
          @endforelse
          <div class="modal fade" id="modalDelete" aria-labelledby="modalToggleLabel" tabindex="-1"
            style="display: none" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalToggleLabel">Hapus</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Yakin hapus Berita <strong>{{ $berita->judul }}</strong>?</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                  </button>
                  <button type="button" class="btn btn-primary"
                    onclick="event.preventDefault(); document.getElementById('delete').submit();">
                    Ya
                  </button>
                  <form action="{{ url('berita/' . $berita->id) }}" method="POST" id="delete">
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
  <div class="card-footer">
    <div class="pagination float-end">
      {{ $beritas->appends(Request::all())->links('pagination::bootstrap-4') }}
    </div>
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
      <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#semua">Semua Berita</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#beras">Beras</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#cabai">Cabai</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#jagung">Jagung</a>
      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#padi">Padi</a>
    </div>
  </div>
  <div class="col-12 col-md-8">
    <div class="tab-content p-0">
      <div class="tab-pane fade show active" id="semua">
        @forelse ($semuas as $semua)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $semua->judul }}</h5>
                <p class="card-text">
                  {{-- {{ $semua->isi }} --}}
                  {{ substr(strip_tags($semua->isi), 0, 320) }}
                  @if (strlen(strip_tags($semua->isi)) > 320)
                  ...
                  <br>
                  <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalBerita{{ $semua->id }}">Baca Selengkapnya</button>
                  @endif
                </p>
                <p class="card-text"><small class="text-muted">{{ $semua->date }}</small></p>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="card mb-3">
          <div class="card-body">
            <p class="card-text text-center">- Berita tidak ditemukan -</p>
          </div>
        </div>
        @endforelse
      </div>
      <div class="tab-pane fade" id="beras">
        @forelse ($berases as $beras)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $beras->judul }}</h5>
                <p class="card-text">
                  {{ substr(strip_tags($beras->isi), 0, 320) }}
                  @if (strlen(strip_tags($beras->isi)) > 320)
                  ...
                  <br>
                  <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalBerita{{ $beras->id }}">Baca Selengkapnya</button>
                  @endif
                </p>
                <p class="card-text"><small class="text-muted">{{ $beras->date }}</small></p>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="card mb-3">
          <div class="card-body">
            <p class="card-text text-center">- Berita tidak ditemukan -</p>
          </div>
        </div>
        @endforelse
      </div>
      <div class="tab-pane fade" id="cabai">
        @forelse ($cabais as $cabai)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $cabai->judul }}</h5>
                <p class="card-text">
                  {{ substr(strip_tags($cabai->isi), 0, 320) }}
                  @if (strlen(strip_tags($cabai->isi)) > 320)
                  ...
                  <br>
                  <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalBerita{{ $cabai->id }}">Baca Selengkapnya</button>
                  @endif
                </p>
                <p class="card-text"><small class="text-muted">{{ $cabai->date }}</small></p>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="card mb-3">
          <div class="card-body">
            <p class="card-text text-center">- Berita tidak ditemukan -</p>
          </div>
        </div>
        @endforelse
      </div>
      <div class="tab-pane fade" id="jagung">
        @forelse ($jagungs as $jagung)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $jagung->judul }}</h5>
                <p class="card-text">
                  {{ substr(strip_tags($jagung->isi), 0, 320) }}
                  @if (strlen(strip_tags($jagung->isi)) > 320)
                  ...
                  <br>
                  <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalBerita{{ $jagung->id }}">Baca Selengkapnya</button>
                  @endif
                </p>
                <p class="card-text"><small class="text-muted">{{ $jagung->date }}</small></p>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="card mb-3">
          <div class="card-body">
            <p class="card-text text-center">- Berita tidak ditemukan -</p>
          </div>
        </div>
        @endforelse
      </div>
      <div class="tab-pane fade" id="padi">
        @forelse ($padis as $padi)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left" src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
                alt="Card image" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $padi->judul }}</h5>
                <p class="card-text">
                  {{ substr(strip_tags($padi->isi), 0, 320) }}
                  @if (strlen(strip_tags($padi->isi)) > 320)
                  ...
                  <br>
                  <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalBerita{{ $padi->id }}">Read
                    More</button>
                  @endif
                </p>
                <p class="card-text"><small class="text-muted">{{ $padi->date }}</small></p>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="card mb-3">
          <div class="card-body">
            <p class="card-text text-center">- Berita tidak ditemukan -</p>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@foreach ($semuas as $semua)
<div class="modal fade" id="modalBerita{{ $semua->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalScrollableTitle">{{ $semua->judul }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img class="rounded" src="{{ asset('sneat/assets/img/elements/12.jpg') }}" alt="{{ $semua->judul }}" />
        <p class="mt-3">{{ $semua->isi }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif
@endsection