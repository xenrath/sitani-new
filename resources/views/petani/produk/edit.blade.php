@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
    <div class="d-flex align-items-start justify-content-between py-3">
        <h4 class="fw-bold pb-2">
            <span class="text-muted fw-light">
                <a href="{{ url('petani/produk') }}">Produk</a> /
            </span> Ubah
        </h4>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" user="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-warning alert-dismissible" user="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Lokasi</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    </head>

    <body>
        <div class="titik">
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div id="map" style="width: 100%; height: 600px; position: relative;"> </div>
            </div>
            <div class="col-sm-5">
                <div class="card-header d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" type="hidden">Ubah Produk</h5>
                    <a href="" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#modalDelete">
                        <i class="bx bxs-trash"></i>&nbsp;Hapus
                    </a>
                </div>
                <form action="{{ url('petani/produk/' . $produk->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="nama">Nama Produk *</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        value="{{ old('nama', $produk->nama) }}" placeholder="Masukan nama produk" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="kategori">Kategori *</label>
                                    <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id"
                                        name="kategori_id">
                                        <option value="">- Pilih -</option>
                                        @foreach ($kategoriproduks as $k)
                                            <option value="{{ $k->id }}"
                                                {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : null }}>
                                                {{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="harga">Harga *</label>
                                    <input type="number" class="form-control" name="harga" id="harga"
                                        value="{{ old('harga', $produk->harga) }}" placeholder="Masukan harga produk" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="stok">Stok *</label>
                                    <input type="number" class="form-control" name="stok" id="stok"
                                        value="{{ old('stok', $produk->stok) }}" placeholder="Masukan stok produk" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    {{-- <label class="form-label" for="latitude">Latitude *</label> --}}
                                    <input type="hidden" class="form-control" name="latitude" id="latitude"
                                        value="{{ old('latitude', $produk->latitude) }}" placeholder="Masukan latitude" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    {{-- <label class="form-label" for="longitude">Longitude *</label> --}}
                                    <input type="hidden" class="form-control" name="longitude" id="longitude"
                                        value="{{ old('longitude', $produk->longitude) }}"
                                        placeholder="Masukan longitude" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="gambar">Gambar</label>
                                    <input type="file" class="form-control" name="gambars[]"
                                        value="{{ old('gambar', $produk->gambar) }}id=" gambar" accept="image/*"
                                        multiple />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="deskripsi">Deskripsi *</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="masukan luas lahan, umur tanaman pangan dan  keadaan tanaman pangan serta alamat rumah">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            @foreach ($gambarproduks as $gambarproduk)
                                <div class="col-md-3 col-sm-6">
                                    <div class="row">
                                        <div class="col-10">
                                            <img src="{{ asset('storage/uploads/' . $gambarproduk->gambar) }}"
                                                alt="{{ $produk->nama }}" class="w-100 rounded">
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ url('petani/hapus-gambar/' . $gambarproduk->id) }}">
                                                <i class="bx bxs-x-circle bx-sm text-danger"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer float-end">
                        <button type="reset" class="btn btn-secondary me-1">
                            <i class="tf-icons bx bx-reset"></i>
                            <span class="d-none d-md-inline">Reset</span>
                            </a>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="tf-icons bx bx-send"></i>
                            <span class="d-none d-md-inline">Kirim</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <script>
            const map = L.map('map').setView([-6.962417, 109.065364], 15);

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                id: 'mapbox/streets-v11',
            }).addTo(map);

            // get latlong 
            const latInput = document.querySelector("[name=latitude]");
            const longInput = document.querySelector("[name=longitude]");

            const lokasiInput = document.querySelector("[name=lokasi]");

            const curLocation = [-6.962417, 109.065364];

            map.attributionControl.setPrefix(false);

            const marker = new L.marker(curLocation, {
                draggable: 'true'
            });

            marker.on('dragend', function(event) {
                const position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();
                $("#latitude").val(position.lat);
                $("#longitude").val(position.lng);
                // tambahan lokasi 
                $("#lokasi").val(position.lat + "," + position.lng);
            });
            map.addLayer(marker);

            map.on("click", function(e) {
                var lat = e.latlng.lat
                var lng = e.latlng.lng
                if (!marker) {
                    marker = L.marker(e.latlng).addTo(map);
                } else {
                    marker.setLatLng(e.latlng);
                }
                latInput.value = lat;
                longInput.value = lng;
                lokasiInput.value = lat + "," +
                    lng;
            });
        </script>
    </body>

    </html>

    <div class="modal fade" id="modalDelete" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel">Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Yakin hapus Produk <strong>{{ $produk->nama }}</strong>?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('delete').submit();">
                        Ya
                    </button>
                    <form action="{{ url('petani/produk/' . $produk->id) }}" method="POST" id="delete">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var kategori_id = document.getElementById('kategori_id');
        var stok = document.getElementById('stok');
        kategori_id.addEventListener('change', function() {
            if (this.value == '2') {
                stok.value = 1;
                stok.setAttribute('type', 'hidden');
            } else {
                stok.setAttribute('type', 'number');
            }
        })
    </script>
@endsection
