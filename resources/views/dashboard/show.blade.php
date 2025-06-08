@extends('layout')
@section('title', 'Detail Produk')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Detail Produk: {{ $produk->nama }}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-fluid rounded">
                @else
                    <img src="https://placehold.co/400x400?text=No+Image" class="img-fluid rounded">
                @endif
            </div>
            <div class="col-md-8">
                <h3>{{ $produk->nama }}</h3>
                <p><strong>Kategori:</strong> {{ $produk->kategori->nama ?? 'N/A' }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($produk->harga) }}</p>
                <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                <hr>
                <strong>Deskripsi:</strong>
                <p>{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
