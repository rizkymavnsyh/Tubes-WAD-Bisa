{{-- Bagian untuk Menampilkan Error Validasi --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <h6 class="font-weight-bold">Oops! Terjadi kesalahan:</h6>
        <ul class="mb-0 pl-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Formulir Utama --}}
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="nama" class="font-weight-bold">Nama Produk</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $produk->nama ?? '') }}" required>
    </div>

    {{-- PERBAIKAN: Menambahkan kolom dropdown untuk Kategori --}}
    <div class="form-group">
        <label for="kategori_id" class="font-weight-bold">Kategori</label>
        <select name="kategori_id" id="kategori_id" class="form-control" required>
            <option value="" disabled selected>-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" @if(old('kategori_id', $produk->kategori_id ?? '') == $kategori->id) selected @endif>
                    {{ ucfirst($kategori->nama) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="harga" class="font-weight-bold">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $produk->harga ?? '') }}" required min="0">
    </div>

    <div class="form-group">
        <label for="stok" class="font-weight-bold">Stok</label>
        <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $produk->stok ?? '') }}" required min="0">
    </div>

    <div class="form-group">
        <label for="deskripsi" class="font-weight-bold">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="gambar" class="font-weight-bold">Gambar Produk (Opsional)</label>
        <input type="file" name="gambar" id="gambar" class="form-control-file">
        @if(isset($produk) && $produk->gambar)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" width="150" class="rounded">
            </div>
        @endif
    </div>

    <hr>
    <div class="text-right">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
