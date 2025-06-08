<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProdukExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $kategoriNama;

    public function __construct(string $kategoriNama)
    {
        $this->kategoriNama = $kategoriNama;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengambil data produk berdasarkan nama kategori yang diberikan
        return Produk::with('kategori')->whereHas('kategori', function ($query) {
            $query->where('nama', $this->kategoriNama);
        })->get();
    }

    /**
     * Menentukan judul untuk setiap kolom di Excel.
     */
    public function headings(): array
    {
        return [
            "ID",
            "Nama Produk",
            "Kategori",
            "Harga",
            "Stok",
            "URL Gambar", // Kolom baru untuk gambar
            "Dibuat Pada",
        ];
    }

    /**
     * Memetakan data dari setiap produk ke kolom yang sesuai.
     */
    public function map($produk): array
    {
        return [
            $produk->id,
            $produk->nama,
            $produk->kategori->nama ?? 'N/A',
            $produk->harga,
            $produk->stok,
            // Menambahkan URL lengkap ke gambar jika ada
            $produk->gambar ? asset('storage/' . $produk->gambar) : 'Tidak ada gambar',
            $produk->created_at->format('d-m-Y H:i'),
        ];
    }

    /**
     * Memberikan gaya pada sheet Excel, seperti membuat header menjadi tebal.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Memberi gaya pada baris pertama (header)
            1    => ['font' => ['bold' => true]],
        ];
    }
}
