{{-- resources/views/dashboard/edit.food.blade.php --}}
<<<<<<< Updated upstream
<<<<<<< Updated upstream
@extends('layouts.app')

@section('content')
    @include('dashboard.form', ['kategori' => 'food', 'produk' => $produk])
=======
=======
>>>>>>> Stashed changes
@extends('layout')

@section('content')
<div class="container">
    <h3>Edit Makanan</h3>
    @include('dashboard.form', [
        'action' => route('produk.food.update', $produk->id),
        'method' => 'PUT',
        'produk' => $produk
    ])
</div>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
@endsection
