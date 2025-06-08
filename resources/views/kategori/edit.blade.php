@extends('layout')
@section('title', 'Edit Kategori')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Edit Kategori</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection