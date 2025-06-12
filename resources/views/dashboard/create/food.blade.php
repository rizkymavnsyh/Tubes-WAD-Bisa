@extends('layout')

@section('title', 'Tambah Makanan')
@section('header', 'Tambah Makanan Baru')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Data Makanan</h6>
    </div>
    <div class="card-body">
        {{-- 
          Baris ini memanggil formulir parsial dan meneruskan semua data yang diperlukan:
          - 'action' untuk URL tujuan formulir.
          - 'method' POST untuk membuat data baru.
          - 'produk' diatur ke null karena ini adalah data baru.
          - 'kategoris' berisi semua kategori dari database untuk ditampilkan di dropdown.
        --}}
        @include('dashboard.form', [
            'action' => route('produk.food.store'),
            'method' => 'POST',
            'produk' => null,
            'kategoris' => $kategoris
        ])
    </div>
</div>
@endsection
