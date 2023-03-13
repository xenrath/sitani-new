@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<div class="d-flex align-items-start justify-content-between py-3">
  <h4 class="fw-bold">
    <span class="text-muted fw-light">
      <a href="{{ url('produk/produk') }}">Produk /</a>
    </span>
    <span id="kategori">Detail</span>
  </h4>
</div>
<div class="card mb-3 p-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img class="card-img card-img-left rounded"
        src="{{ asset('storage/uploads/' . $produk->gambar->first()->gambar) }}" alt="{{ $produk->nama }}" />
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ $produk->nama }}</h5>
        <p class="card-text">
          {{ $produk->deskripsi }}
        </p>
        <p class="card-text">
          <small class="text-muted">{{ $produk->kategori->nama }}</small>
        </p>
        @if ($produk->kategori->nama == 'Biasa')
        <p class="card-text">
          Stok : {{ $produk->stok }}
        </p>
        @endif
        <p class="fw-bold">
          @rupiah($produk->harga)
        </p>
        {{-- @php
        if ($produk->kategori->nama == 'Biasa') {
        $text = "Permisi,%20Saya%20 " . auth()->user()->nama . "%20dari%20" . auth()->user()->alamat .
        ".%0ASaya%20tertarik%20dengan%20produk%20" . $produk->nama . "%20(" . $produk->kategori->nama .
        ")%20Anda%20dengan%20harga%20" . $produk->harga;
        } else {
        $text = "Permisi,%20Saya%20 " . auth()->user()->nama . "%20dari%20" . auth()->user()->alamat .
        ".%0ASaya%20tertarik%20dengan%20produk%20" . $produk->nama . "%20(" . $produk->kategori->nama .
        ")%20Anda%20dengan%20harga%20" . $produk->harga;
        }
        @endphp --}}
        {{-- <a href="https://web.whatsapp.com/send?phone=+6285328481969&text={{ $text }}" target="_blank"
          class="btn rounded-pill mt-4" style="background-color: #25D366; color: white;">
          <i class="bx bxl-whatsapp"></i>
          <span class="align-middle">Hubungi Penjual</span>
        </a> --}}
        <form action="{{ url('tengkulak/produk/konfirmasi/' . $produk->id) }}" autocomplete="off" method="POST"
          id="form-konfirmasi">
          @csrf
          @if ($produk->kategori->nama == 'Biasa')
          @php
          $stok = $produk->stok;
          @endphp
          @if ($stok != '0')
          <div class="form-group">
            <label for="jumlah">Masukan jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah"
              oninput="this.value = !!this.value && Math.abs(this.value) >= 0 && !!this.value && Math.abs(this.value) <= {{ $stok }} ? Math.abs(this.value) : null"
              onkeypress="return event.keyCode != 13">
          </div>
          @endif
          @endif
          @if ($produk->kategori->nama == 'Tebas')
          <input type="hidden" class="form-control" id="jumlah" name="jumlah" value="1">
          @endif
        </form>
        @if ($produk->stok != 0)
        <button type="button" class="btn rounded-pill mt-4" style="background-color: #25D366; color: white;"
          onclick="hubungi('{{ $produk->kategori->nama }}')">
          <i class="bx bxl-whatsapp"></i>
          <span class="align-middle">Lakukan Transaksi</span>
        </button>
        @else
        <span class="badge bg-label-warning">Produk Sedang Dalam Transaksi</span>
        @endif

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiBiasa"
          id="btn-konfirmasi-biasa" style="display: none">Konfirmasi Biasa</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiTebas"
          id="btn-konfirmasi-tebas" style="display: none">Konfirmasi Tebas</button>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalGagal"
          id="btn-gagal" style="display: none">Gagal</button>

        <div class="modal fade" id="modalKonfirmasiBiasa" aria-labelledby="modalToggleLabel" tabindex="-1"
          style="display: none" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">Yakin melakukan penawaran produk <strong>{{ $produk->nama }}</strong> sejumlah
                <strong id="strongjumlah"></strong>?<br>Total harga yang harus dibayar : <strong
                  id="strongtotal"></strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                document.getElementById('form-konfirmasi').submit();">Ya</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalKonfirmasiTebas" aria-labelledby="modalToggleLabel" tabindex="-1"
          style="display: none" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">Yakin melakukan penawaran produk <strong>{{ $produk->nama }}</strong> dengan harga
                <strong>@rupiah($produk->harga)</strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                  document.getElementById('form-konfirmasi').submit();">Ya</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalGagal" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">Gagal!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">Masukan jumlah dengan benar!</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Oke</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var jumlah = document.getElementById('jumlah');
  var strongjumlah = document.getElementById('strongjumlah');
  var strongtotal = document.getElementById('strongtotal');
  var harga = "{{ $produk->harga }}";
  function hubungi(kategori) {
    if (kategori == 'Biasa') {
      if (jumlah.value == 0) {
        document.getElementById('btn-gagal').click();
      } else {
        strongjumlah.textContent = jumlah.value;
        var total = harga * jumlah.value;
        strongtotal.textContent = rupiah("" + total, 'Rp');
        document.getElementById('btn-konfirmasi-biasa').click();
      }
    } else {
      document.getElementById('btn-konfirmasi-tebas').click();
    }
  }
  function rupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
  }
</script>
@endsection