<form action="{{ $action }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $produk->nama ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori', $produk->kategori ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $produk->harga ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $produk->stok ?? '') }}" required>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
