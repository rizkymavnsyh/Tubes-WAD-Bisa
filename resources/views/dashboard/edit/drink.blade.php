<<<<<<< Updated upstream
<<<<<<< Updated upstream
{{-- resources/views/dashboard/edit.drink.blade.php --}}
@extends('layouts.app')

@section('content')
    @include('dashboard.form', ['kategori' => 'drink', 'produk' => $produk])
=======
=======
>>>>>>> Stashed changes
{{-- resources/views/dashboard/edit.food.blade.php --}}
@extends('layout')

@section('content')
<div class="container">
    <h3>Edit Minuman</h3>
    @include('dashboard.form', [
        'action' => route('produk.drink.update', $produk->id),
        'method' => 'PUT',
        'produk' => $produk
    ])
</div>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
@endsection
