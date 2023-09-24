@extends('layouts.app')

@section('title', 'Statistik Pangan')

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
        <div class="card">
            <h5 class="card-header d-flex align-items-start justify-content-between">
                {{ date('d M Y', strtotime($pangan->created_at)) }}
            </h5>
            <div class="card-body">
                <canvas id="chart"></canvas>
            </div>
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('chart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($label),
                datasets: [{
                    label: 'Harga',
                    data: @json($data),
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
    </script>
@endsection
