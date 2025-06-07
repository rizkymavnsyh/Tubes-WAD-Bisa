@extends('layout')

@section('content')
<div class="container-fluid px-5 py-4">
    <h2 class="mb-4 fw-bold">Overview</h2>

    <div class="row mb-5">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Food in Stock</h6>
                    <h2>{{ $total_food_stock }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Drink in Stock</h6>
                    <h2>{{ $total_drinks_stock }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">% Food in Stock</h6>
                    <h2>{{ round(($total_food_stock / ($total_food_stock + $total_drinks_stock)) * 100, 2) }}%</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">% Drink in Stock</h6>
                    <h2>{{ round(($total_drinks_stock / ($total_food_stock + $total_drinks_stock)) * 100, 2) }}%</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tabel Produk -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Food</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produks as $produk)
                            <tr>
                                <td>{{ $produk->id }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>{{ ucfirst($produk->kategori) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Simulasi Donut Chart: Chart.js -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-bold">Food and Drink Percentage in Stock</div>
                <div class="card-body">
                    <canvas id="stockChart"></canvas>
                </div>
            </div>
        </div>

@php
    $foodPercentage = round(($total_food_stock / ($total_food_stock + $total_drinks_stock)) * 100, 2);
    $drinkPercentage = 100 - $foodPercentage;
@endphp

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Food', 'Drink'],
                datasets: [{
                    data: [{{ $foodPercentage }}, {{ $drinkPercentage }}],
                    backgroundColor: ['#4e73df', '#1cc88a'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>

@endsection
