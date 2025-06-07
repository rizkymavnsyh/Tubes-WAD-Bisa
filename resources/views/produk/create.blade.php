@extends('layout')

@section('content')
<h1>Tambah Produk</h1>

@include('produk.form', ['action' => route('produk.store'), 'method' => 'POST', 'produk' => null])
@endsection
