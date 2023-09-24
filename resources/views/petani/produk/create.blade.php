@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="d-flex align-items-start justify-content-between py-3">
        <h4 class="fw-bold pb-2">
            <span class="text-muted fw-light">
                <a href="{{ url('petani/produk') }}">Produk</a> /
            </span> Tambah
        </h4>
    </div>
    @if (session('status'))
        <div class="alert alert-danger alert-dismissible" user="alert">
            <h5 class="text-danger">Error!</h5>
            <p>
                @foreach (session('status') as $error)
                    -&nbsp; {{ $error }} <br>
                @endforeach
            </p>
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

                <form action="{{ url('petani/produk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="nama">Nama Produk *</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        value="{{ old('nama') }}" placeholder="masukan nama produk" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="kategori">Kategori *</label>
                                    <select class="form-select" id="kategori_id" name="kategori_id">
                                        <option value="">- Pilih -</option>
                                        @foreach ($kategoriproduks as $k)
                                            <option value="{{ $k->id }}"
                                                {{ old('kategori_id') == $k->id ? 'selected' : null }}>{{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="harga">Harga *</label>
                                    <input type="number" class="form-control" name="harga" id="harga"
                                        value="{{ old('harga') }}" placeholder="masukan harga"
                                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" />
                                </div>
                            </div>
                            <div class="col-md-6" id="layout_stok">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="stok">Stok *</label>
                                    <input type="number" class="form-control" name="stok" value="{{ old('stok') }}"
                                        id="stok" placeholder="masukan stok"
                                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    {{-- <label class="form-label" for="latitude">Latitude *</label> --}}
                                    <input type="hidden" class="form-control" name="latitude" id="latitude"
                                        value="{{ old('latitude') }}" placeholder="masukan latitude" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    {{-- <label class="form-label" for="longitude">Longitude *</label> --}}
                                    <input type="hidden" class="form-control" name="longitude" id="longitude"
                                        value="{{ old('longitude') }}" placeholder="masukan longitude" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="gambar">Gambar *</label>
                                    <input type="file" class="form-control" name="gambar[]" id="gambar"
                                        accept="image/*" multiple />
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="deskripsi">Deskripsi *</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"
                                        placeholder="masukan luas lahan, umur tanaman pangan dan  keadaan tanaman pangan serta alamat rumah">{{ old('deskripsi') }}</textarea>
                                </div>
                            </div>
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
    <script>
        var kategori_id = document.getElementById('kategori_id');
        var layout_stok = document.getElementById('layout_stok');
        var stok = document.getElementById('stok');
        kategori_id.addEventListener('change', function() {
            if (this.value == '2') {
                stok.value = 1;
                layout_stok.style.display = 'none';
            } else {
                stok.value = '';
                layout_stok.style.display = 'inline';
            }
        })
    </script>
@endsection
