@extends('layout')

@section('title', 'Tambah Minuman')
@section('header', 'Formulir Tambah Minuman')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Minuman Baru</h6>
    </div>
    <div class="card-body">
        {{-- Formulir ini mengirim data ke route 'produk.drink.store' --}}
        <form action="{{ route('produk.drink.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Menggunakan formulir parsial dan mengatur kategori default ke 'Minuman' --}}
            @include('form', ['kategori_default' => 'Minuman'])

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('produk.drink.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
