<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProdukExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
            $produk->created_at->format('d-m-Y H:i'),
        ];
    }
}
