@extends('layout')

@section('content')
<div class="container">
    <h3>Drink Data</h3>
    <div class="d-flex justify-content-between my-2">
        <button class="btn btn-dark"><i class="fas fa-print"></i> Print</button>
        <a href="{{ route('produk.drink.create') }}" class="btn btn-primary">Add +</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input type="checkbox" /></th>
                <th>id</th>
                <th>nama</th>
                <th>harga</th>
                <th>stok</th>
                <th>dibuat pada</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drinks as $drink)
            <tr>
                <td><input type="checkbox" /></td>
                <td>{{ $drink->id }}</td>
                <td>{{ $drink->nama }}</td>
                <td>{{ number_format($drink->harga, 0, ',', '.') }}</td>
                <td>{{ $drink->stok }}</td>
                <td>{{ $drink->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('produk.drink.edit', $drink->id) }}" class="btn btn-sm btn-primary">✏️</a>
                    <form action="{{ route('produk.drink.delete', $drink->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $drinks->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection