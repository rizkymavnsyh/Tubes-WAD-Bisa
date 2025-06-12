@extends('layout')

@section('header', 'Tambah Minuman')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        {{-- 
          PERBAIKAN: Judul diubah menjadi "Tambah Minuman".
          Sebelumnya mungkin tertulis "Tambah Makanan" di sini.
        --}}
        <h5 class="mb-0 fw-bold">Tambah Minuman</h5>
    </div>
    <div class="card-body">
        {{-- 
          Bagian ini memanggil formulir parsial (dashboard.form) dan mengirimkan
          variabel yang diperlukan untuk menyimpan data minuman baru.
        --}}
        @include('dashboard.form', [
            'action' => route('produk.drink.store'),
            'method' => 'POST',
            'produk' => null
        ])
    </div>
</div>
@endsection
