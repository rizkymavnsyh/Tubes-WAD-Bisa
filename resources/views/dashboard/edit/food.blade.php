@extends('layout')

@section('header', 'Edit Makanan')
@section('title', 'Edit Makanan')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Data Makanan</h6>
    </div>
    <div class="card-body">
        @include('dashboard.form', [
            'action' => route('produk.food.update', $produk->id),
            'method' => 'PUT',
            'produk' => $produk,
            'kategoris' => $kategoris
        ])
    </div>
</div>
@endsection