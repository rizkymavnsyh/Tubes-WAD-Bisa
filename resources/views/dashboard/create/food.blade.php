@extends('layout')

@section('title', 'Tambah Makanan')
@section('header', 'Formulir Tambah Makanan')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Makanan Baru</h6>
    </div>
    <div class="card-body">
        {{-- Formulir ini mengirim data ke route 'produk.food.store' --}}
        <form action="{{ route('produk.food.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Menggunakan formulir parsial dan mengatur kategori default ke 'Makanan' --}}
            @include('form', ['kategori_default' => 'Makanan'])

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('produk.food.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
