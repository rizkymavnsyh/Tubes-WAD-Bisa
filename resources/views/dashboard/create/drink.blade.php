<<<<<<< Updated upstream
<<<<<<< Updated upstream
{{-- resources/views/dashboard/create.drink.blade.php --}}
@extends('layouts.app')

@section('content')
    @include('dashboard.form', ['kategori' => 'drink'])
=======
=======
>>>>>>> Stashed changes
{{-- resources/views/dashboard/create.food.blade.php --}}
@extends('layout')

@section('content')
<div class="container">
    <h3>Tambah Minuman</h3>
    @include('dashboard.form', [
        'action' => route('produk.drink.store'),
        'method' => 'POST',
        'produk' => null
    ])
</div>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
@endsection
