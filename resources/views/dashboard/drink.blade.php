@extends('layout')

@section('title', 'Data Minuman')
@section('header', 'Manajemen Minuman')

@section('content')

<h1 class="h3 mb-2 text-gray-800">Data Minuman</h1>
<p class="mb-4">Kelola semua produk minuman Anda. Tambah, ubah, hapus, dan ekspor data dari tabel di bawah ini.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Minuman</h6>
            <a href="{{ route('produk.drink.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-8">
                <form action="{{ route('produk.drink.index') }}" method="GET" class="d-flex">
                    <div class="input-group input-group-sm mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama minuman..." value="{{ request('search') }}">
                    </div>
                    <div class="input-group input-group-sm mr-2" style="max-width: 180px;">
                        <select class="form-control" name="sort_by">
                            <option value="terbaru" @if(request('sort_by') == 'terbaru') selected @endif>Urutkan: Terbaru</option>
                            <option value="terlama" @if(request('sort_by') == 'terlama') selected @endif>Urutkan: Terlama</option>
                            <option value="harga_terendah" @if(request('sort_by') == 'harga_terendah') selected @endif>Harga: Terendah</option>
                            <option value="harga_tertinggi" @if(request('sort_by') == 'harga_tertinggi') selected @endif>Harga: Tertinggi</option>
                            <option value="nama_az" @if(request('sort_by') == 'nama_az') selected @endif>Nama: A-Z</option>
                            <option value="nama_za" @if(request('sort_by') == 'nama_za') selected @endif>Nama: Z-A</option>
                        </select>
                    </div>
                    <button class="btn btn-secondary btn-sm" type="submit"><i class="fas fa-filter"></i></button>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('produk.drink.export.pdf') }}" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
                <a href="{{ route('produk.drink.export.excel') }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Excel</a>
            </div>
        </div>

        {{-- FORM AKSI MASSAL DIMULAI DI SINI, SEKARANG MEMBUNGKUS SELURUH TABEL --}}
        <form action="{{ route('produk.drink.bulkDelete') }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus semua item yang dipilih?');">
            @csrf
            {{-- Pastikan tombol ini memiliki type="submit" dan merupakan bagian dari form --}}
            <button type="submit" class="btn btn-danger btn-sm mb-3"><i class="fas fa-trash"></i> Hapus yang Dipilih</button>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="3%"><input type="checkbox" id="select-all"></th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($drinks as $drink)
                        <tr class="{{ $drink->stok < 10 ? 'table-warning' : '' }}">
                            <td><input type="checkbox" name="ids[]" class="checkbox-item" value="{{ $drink->id }}"></td>
                            <td>
                                <img src="{{ $drink->gambar ? asset('storage/' . $drink->gambar) : 'https://placehold.co/80x80/EBF4FF/7F9CF5?text=N/A' }}" alt="{{$drink->nama}}" width="60" class="rounded" onerror="this.onerror=null;this.src='https://placehold.co/80x80/EBF4FF/7F9CF5?text=Error';">
                            </td>
                            <td><a href="{{ route('produk.show', $drink->id) }}">{{ $drink->nama }}</a></td>
                            {{-- Mengakses nama kategori melalui relasi dan menerapkan warna badge dinamis --}}
                            <td><span class="badge {{($drink->kategori->nama ?? '') == 'minuman' ? 'badge-success' : 'badge-primary'}}">{{ $drink->kategori->nama ?? 'N/A' }}</span></td>
                            <td>Rp {{ number_format($drink->harga) }}</td>
                            <td>
                                {{ $drink->stok }}
                                @if($drink->stok < 10)
                                    <i class="fas fa-exclamation-triangle text-warning ml-1" title="Stok rendah!"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('produk.drink.edit', $drink->id) }}" class="btn btn-warning btn-circle btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                {{-- FORM HAPUS SATU PER SATU berada di sini, di LUAR form bulk delete --}}
                                <form action="{{ route('produk.drink.delete', $drink->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                {{ $drinks->appends(request()->query())->links() }}
            </div>
        </form> {{-- FORM AKSI MASSAL DITUTUP DI SINI --}}
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.checkbox-item');

        selectAll.addEventListener('change', function () {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (!this.checked) {
                    selectAll.checked = false;
                } else {
                    let allChecked = true;
                    checkboxes.forEach(cb => {
                        if (!cb.checked) { allChecked = false; }
                    });
                    selectAll.checked = allChecked;
                }
            });
        });
    });
</script>
@endpush