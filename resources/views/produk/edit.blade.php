@extends('layout')

@section('content')
<h1>Edit Produk</h1>

@include('produk.form', ['action' => route('produk.update', $produk->id), 'method' => 'PUT', 'produk' => $produk])
@endsection
