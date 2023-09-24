@extends('layouts.app')

@section('title', 'Tambah Kategori harga')

@section('content')
    @if (auth()->check() &&
            auth()->user()->isAdmin())
        <h4 class="fw-bold py-3 mb-4">Statistik Pangan</h4>
        @if (session('status'))
            <div class="alert alert-primary alert-dismissible" user="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            @foreach ($statistik as $item)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <h5 class="card-header d-flex align-items-start justify-content-between">
                            {{ $item['pangan'] }}
                        </h5>
                        <div class="card-body">
                            <canvas id="{{ $item['id'] }}"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const statistik = @json($statistik);
        
        for (let i = 0; i < statistik.length; i++) {
            setGrafik(statistik[i]);
        }

        function setGrafik(params) {
            const ctx = document.getElementById(params.id);
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: params.label,
                    datasets: [{
                        label: 'Harga',
                        data: params.data,
                        borderWidth: 1,
                        barThickness: 40,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endsection
