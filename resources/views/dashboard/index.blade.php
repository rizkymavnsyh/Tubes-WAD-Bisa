@extends('layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@push('styles')
<style>
    /* Kustomisasi gaya agar lebih mirip dengan desain gambar */
    .card.border-left-primary { border-left: .25rem solid #4e73df!important; }
    .card.border-left-success { border-left: .25rem solid #1cc88a!important; }
    .card.border-left-info { border-left: .25rem solid #36b9cc!important; }
    .card.border-left-warning { border-left: .25rem solid #f6c23e!important; }
    .text-xs { font-size: .7rem; }
    .progress-sm { height: .5rem; }
    .card .card-header { background-color: white; border-bottom: 1px solid #e3e6f0; }
</style>
@endpush

@section('content')

<!-- Kartu Statistik Utama (Gaya Baru) -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stok Makanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_food_stock }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-utensils fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Stok Minuman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_drinks_stock }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-cocktail fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    @php
        $totalStock = $total_food_stock + $total_drinks_stock;
        $foodPercentage = $totalStock > 0 ? round(($total_food_stock / $totalStock) * 100) : 0;
        $drinkPercentage = $totalStock > 0 ? round(($total_drinks_stock / $totalStock) * 100) : 0;
    @endphp
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">% Stok Makanan</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$foodPercentage}}%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{$foodPercentage}}%" aria-valuenow="{{$foodPercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-chart-pie fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">% Stok Minuman</div>
                         <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$drinkPercentage}}%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$drinkPercentage}}%" aria-valuenow="{{$drinkPercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-chart-pie fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Baris untuk Tabel dan Pie Chart -->
<div class="row">
    <!-- TABEL - 5 PRODUK TERBARU -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">5 Produk Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" width="100%" cellspacing="0">
                        <thead>
                            <tr style="border-bottom: 1px solid #e3e6f0;">
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                             @forelse ($produks as $produk)
                            <tr>
                                <td>{{ $produk->nama }}</td>
                                <td><span class="badge badge-pill {{($produk->kategori->nama ?? '') == 'makanan' ? 'badge-primary' : 'badge-success'}}">{{ ucfirst($produk->kategori->nama ?? 'N/A') }}</span></td>
                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada produk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- PIE CHART - KOMPOSISI STOK -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Komposisi Stok</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2" style="height: 255px;">
                    <canvas id="stockPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2"><i class="fas fa-circle text-primary"></i> Makanan</span>
                    <span class="mr-2"><i class="fas fa-circle text-success"></i> Minuman</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Baris untuk Chart Lainnya -->
<div class="row">
    <!-- BAR CHART - PRODUK STOK TERBANYAK -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">5 Produk dengan Stok Terbanyak</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="height: 320px;">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- HORIZONTAL BAR CHART - PRODUK TERMAHAL -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">5 Produk Termahal</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="height: 320px;">
                    <canvas id="topPriceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Fungsi bantuan untuk format Rupiah
    const formatRupiah = (number) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);

    // PIE CHART: Komposisi Stok
    const stockPieCtx = document.getElementById("stockPieChart").getContext('2d');
    new Chart(stockPieCtx, {
        type: 'doughnut',
        data: {
            labels: ["Makanan", "Minuman"],
            datasets: [{
                data: [{{ $total_food_stock }}, {{ $total_drinks_stock }}],
                backgroundColor: ['#4e73df', '#1cc88a'],
                hoverBackgroundColor: ['#2e59d9', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed !== null) {
                                label += context.parsed;
                            }
                            return label;
                        }
                    }
                }
            },
            cutout: '80%',
        },
    });

    // BAR CHART: Top 5 Stok Terbanyak
    const topProductsCtx = document.getElementById("topProductsChart").getContext('2d');
    new Chart(topProductsCtx, {
        type: 'bar',
        data: {
            labels: [@foreach($top_stock_produks as $produk) "{{ \Illuminate\Support\Str::limit($produk->nama, 15) }}", @endforeach],
            datasets: [{
                label: "Jumlah Stok",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: [@foreach($top_stock_produks as $produk) {{ $produk->stok }}, @endforeach],
                maxBarThickness: 25,
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { 
                y: { 
                    ticks: { 
                        beginAtZero: true,
                        precision: 0 
                    } 
                } 
            }
        }
    });

    // HORIZONTAL BAR CHART: 5 Produk Termahal
    const topPriceCtx = document.getElementById("topPriceChart").getContext('2d');
    new Chart(topPriceCtx, {
        type: 'bar',
        data: {
            labels: [@foreach($top_price_produks as $produk) "{{ \Illuminate\Support\Str::limit($produk->nama, 25) }}", @endforeach],
            datasets: [{
                label: "Harga",
                backgroundColor: '#f6c23e',
                hoverBackgroundColor: '#dda20a',
                borderColor: '#f6c23e',
                data: [@foreach($top_price_produks as $produk) {{ $produk->harga }}, @endforeach],
            }]
        },
        options: {
            indexAxis: 'y', // Mengatur chart menjadi horizontal
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (context) => formatRupiah(context.parsed.x)
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        beginAtZero: true,
                        callback: (value) => formatRupiah(value)
                    }
                }
            }
        }
    });
});
</script>
@endpush
