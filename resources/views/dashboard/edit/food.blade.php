{{-- resources/views/dashboard/edit.food.blade.php --}}
@extends('layouts.app')

@section('content')
    @include('dashboard.form', ['kategori' => 'food', 'produk' => $produk])
@endsection
