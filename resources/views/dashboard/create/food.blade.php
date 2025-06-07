{{-- resources/views/dashboard/create.food.blade.php --}}
<<<<<<< Updated upstream
<<<<<<< Updated upstream
@extends('layouts.app')

@section('content')
    @include('dashboard.form', ['kategori' => 'food'])
=======
=======
>>>>>>> Stashed changes
@extends('layout')

@section('content')
<div class="container">
    <h3>Tambah Makanan</h3>
    @include('dashboard.form', [
        'action' => route('produk.food.store'),
        'method' => 'POST',
        'produk' => null
    ])
</div>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
@endsection
