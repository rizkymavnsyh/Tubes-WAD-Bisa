@extends('layout')
@section('title', 'Manajemen Kategori')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jumlah Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kategori)
                    <tr>
                        <td>{{ $kategori->nama }}</td>
                        <td>{{ $kategori->produks_count }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $kategoris->links() }}
        </div>
    </div>
</div>
@endsection