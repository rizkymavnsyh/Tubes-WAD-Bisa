{{-- resources/views/dashboard/edit.drink.blade.php --}}
@extends('layouts.app')

@section('content')
    @include('dashboard.form', ['kategori' => 'drink', 'produk' => $produk])
@endsection
