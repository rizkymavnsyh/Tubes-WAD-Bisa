<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Produk - {{ ucfirst($kategori) }}</title>
    <style>
        @page {
            margin: 0.5cm 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #212529;
        }
        
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #6c757d;
        }

        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 10px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            line-height: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        thead th {
            background-color: #0d6efd;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .text-center {
            text-align: center;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            display: block;
            margin: auto;
        }
        .img-placeholder {
            width: 60px;
            height: 60px;
            background-color: #e9ecef;
            text-align: center;
            line-height: 60px;
            color: #adb5bd;
            font-size: 10px;
            border-radius: 4px;
            margin: auto;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Stok Produk</h1>
        <p>Kategori: <strong>{{ ucfirst($kategori) }}</strong> | Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <div class="footer">
        MyApp &copy; {{ date('Y') }} - Halaman <span class="pagenum"></span>
    </div>

    <main>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Gambar</th>
                    <th>Nama Produk</th>
                    <th style="width: 20%;">Kategori</th>
                    <th style="width: 15%;">Harga</th>
                    <th style="width: 10%;">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $index => $produk)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        @if ($produk->gambar && file_exists(public_path('storage/' . $produk->gambar)))
                            <img src="{{ public_path('storage/' . $produk->gambar) }}" alt="Gambar Produk" class="product-image">
                        @else
                            <div class="img-placeholder">No Image</div>
                        @endif
                    </td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->kategori->nama ?? 'Tidak ada kategori' }}</td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $produk->stok }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data produk untuk kategori ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>

</body>
</html>
