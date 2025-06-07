@extends('layout')

@section('content')
<h4>{{ isset($produk) ? 'Edit' : 'Add' }} {{ ucfirst($kategori) }}</h4>
<form method="POST" action="{{ isset($produk) 
    ? route("produk.$kategori.update", $produk->id) 
    : route("produk.$kategori.store") }}">
    
    @csrf
    @if(isset($produk)) @method('PUT') @endif

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $produk->nama ?? '' }}" required>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $produk->harga ?? '' }}" required>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $produk->stok ?? '' }}" required>
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
