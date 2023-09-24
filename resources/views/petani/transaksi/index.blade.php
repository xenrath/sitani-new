@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
    <div class="d-flex align-items-start justify-content-between py-3">
        <h4 class="fw-bold pb-2">Transaksi</h4>
    </div>
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible" user="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-header d-flex align-items-start justify-content-between">
                    Menunggu Konfirmasi
                </h5>
                <div class="card-body p-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($menunggus as $menunggu)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $menunggu->produk->nama }} ({{ $menunggu->produk->kategori->nama }})</td>
                                        <td>
                                            @if ($menunggu->produk->kategori->nama == 'Biasa')
                                                {{ $menunggu->jumlah }} Kg
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn rounded-pill btn-info btn-sm text-white"
                                                data-bs-toggle="modal" data-bs-target="#modalLihat{{ $menunggu->id }}">
                                                <i class="tf-icons bx bxs-show"></i>
                                                <span class="d-none d-md-inline">Lihat</span>
                                            </button>
                                            <div class="modal fade" id="modalLihat{{ $menunggu->id }}"
                                                aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalToggleLabel">Lihat Transaksi
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <table>
                                                                <tr>
                                                                    <td class="align-top">Nama Tengkulak</td>
                                                                    <td class="align-top text-center" width="20px">:</td>
                                                                    <td class="text-wrap">{{ $menunggu->tengkulak->nama }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="align-top">Produk</td>
                                                                    <td class="align-top text-center" width="20px">:</td>
                                                                    <td class="text-wrap">{{ $menunggu->produk->nama }}
                                                                        ({{ $menunggu->produk->kategori->nama }})
                                                                    </td>
                                                                </tr>
                                                                @if ($menunggu->produk->kategori->nama == 'Biasa')
                                                                    <tr>
                                                                        <td class="align-top">Jumlah</td>
                                                                        <td class="align-top text-center" width="20px">:
                                                                        </td>
                                                                        <td class="text-wrap">{{ $menunggu->jumlah }} Kg
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td class="align-top">Tanggal</td>
                                                                    <td class="align-top text-center" width="20px">:</td>
                                                                    <td class="text-wrap">
                                                                        {{ date('d M Y', strtotime($menunggu->created_at)) }}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalKonfirmasi{{ $menunggu->id }}"
                                                                data-bs-dismiss="modal">Konfirmasi</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalBatal{{ $menunggu->id }}"
                                                                data-bs-dismiss="modal">Batalkan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modalKonfirmasi{{ $menunggu->id }}"
                                                aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalToggleLabel">Konfirmasi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin konfirmasi penawaran produk
                                                            <strong>{{ $menunggu->produk->nama }}</strong> dari
                                                            <strong>{{ $menunggu->tengkulak->nama }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <a href="{{ url('petani/transaksi/konfirmasi/' . $menunggu->id) }}"
                                                                class="btn btn-primary">Ya</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modalBatal{{ $menunggu->id }}"
                                                aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalToggleLabel">Batalkan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin batalkan penawaran produk
                                                            <strong>{{ $menunggu->produk->nama }}</strong> dari
                                                            <strong>{{ $menunggu->tengkulak->nama }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <a href="{{ url('transaksi/batalkan/' . $menunggu->id) }}"
                                                                class="btn btn-primary">Ya</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">- Data tidak ditemukan -</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header d-flex align-items-start justify-content-between">
                    Riwayat
                    {{-- <a href="{{ url('petani/cetak-pdf') }}" target="_blank"
                        class="btn btn-sm rounded-pill btn-primary">
                        <i class="tf-icons bx bxs-archive-in"></i>
                        <span class="d-none d-md-inline">Print</span>
                    </a> --}}
                </h5>
                <div class="card-body p-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($riwayats as $riwayat)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $riwayat->produk->nama }} ({{ $riwayat->produk->kategori->nama }})</td>
                                        <td>
                                            @if ($riwayat->produk->kategori->nama == 'Biasa')
                                                {{ $riwayat->jumlah }} Kg
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($riwayat->status == 'selesai')
                                                <span class="badge bg-label-success">Selesai</span>
                                            @else
                                                <span class="badge bg-label-danger">Gagal</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('petani/cetak-pdf/' . $riwayat->id) }}" target="_blank"
                                                class="btn btn-sm rounded-pill btn-primary">
                                                <i class="tf-icons bx bxs-archive-in"></i>
                                                <span class="d-none d-md-inline">Invoice</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">- Data tidak ditemukan -</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
