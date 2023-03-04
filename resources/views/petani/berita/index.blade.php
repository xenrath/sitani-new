@extends('layouts.app')

@section('title', 'Berita')

@section('content')
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
      @foreach ($kategoripangans as $kategoripangan)
      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#{{ $kategoripangan->kategori }}">{{
        $kategoripangan->nama }}</a>
      @endforeach
    </div>
  </div>
  <div class="col-12 col-md-8">
    <div class="tab-content p-0">
      <div class="tab-pane fade show active" id="semua">
        @forelse ($semuas as $semua)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left h-100" src="{{ asset('storage/uploads/' . $semua->gambar) }}"
                alt="Card image" style="object-position: center; object-fit: cover;" />
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
                  <button type="button" class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalBerita{{ $semua->id }}">Baca Selengkapnya</button>
                  @endif
                </p>
                <p class="card-text"><small class="text-muted">{{ date('d M Y', strtotime($semua->created_at))
                    }}</small></p>
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
      @foreach ($kategoripangans as $kategoripangan)
      <div class="tab-pane fade" id="{{ $kategoripangan->kategori }}">
        @php
        $beritas = \App\Models\Berita::where('kategoripangan_id', $kategoripangan->id)->get();
        @endphp
        @forelse ($beritas as $berita)
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img class="card-img card-img-left h-100" src="{{ asset('storage/uploads/' . $berita->gambar) }}"
                alt="Card image" style="object-position: center; object-fit: cover;" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $berita->judul }}</h5>
                <p class="card-text">
                  {{ substr(strip_tags($berita->isi), 0, 320) }}
                  @if (strlen(strip_tags($berita->isi)) > 320)
                  ...
                  <br>
                  <button type="button" class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalBerita{{ $berita->id }}">Baca Selengkapnya</button>
                  @endif
                </p>
                <p class="card-text"><small class="text-muted">{{ date('d M Y', strtotime($berita->created_at))
                    }}</small></p>
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
      @endforeach
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
        <img class="rounded w-100" src="{{ asset('storage/uploads/' . $semua->gambar) }}" alt="{{ $semua->judul }}" />
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
@endsection