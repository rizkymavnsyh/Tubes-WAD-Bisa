@extends('layout')

@section('header', 'Edit Minuman')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">Edit Minuman</h5>
    </div>
    <div class="card-body">
        @include('dashboard.form', [
            'action' => route('produk.drink.update', $produk->id),
            'method' => 'PUT',
            'produk' => $produk,
            'kategoris' => $kategoris
        ])
    </div>
</div>
@endsection