<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama.
     */
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->take(5)->get();
        $total_food_stock = Produk::whereHas('kategori', function ($q) { $q->where('nama', 'makanan'); })->sum('stok');
        $total_drinks_stock = Produk::whereHas('kategori', function ($q) { $q->where('nama', 'minuman'); })->sum('stok');
        
        // Mengambil 5 produk dengan stok terbanyak untuk chart bar
        $top_stock_produks = Produk::orderBy('stok', 'desc')->take(5)->get();
        
        // BARU: Mengambil 5 produk termahal untuk chart horizontal bar
        $top_price_produks = Produk::orderBy('harga', 'desc')->take(5)->get();

        return view('dashboard.index', compact(
            'produks',
            'total_food_stock',
            'total_drinks_stock',
            'top_stock_produks',
            'top_price_produks' // Mengirim data baru ke view
        ));
    }

    /**
     * Menampilkan halaman detail untuk satu produk.
     */
    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return view('dashboard.show', compact('produk'));
    }

    /**
     * Menerapkan filter pencarian dan pengurutan pada query.
     */
    private function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $sortBy = $request->input('sort_by', 'terbaru');
        switch ($sortBy) {
            case 'terlama': $query->orderBy('created_at', 'asc'); break;
            case 'harga_terendah': $query->orderBy('harga', 'asc'); break;
            case 'harga_tertinggi': $query->orderBy('harga', 'desc'); break;
            case 'nama_az': $query->orderBy('nama', 'asc'); break;
            case 'nama_za': $query->orderBy('nama', 'desc'); break;
            default: $query->orderBy('created_at', 'desc'); break;
        }
        return $query;
    }

    /**
     * Mengambil data produk berdasarkan nama kategori.
     */
    private function getProdukByKategori($kategoriNama, Request $request)
    {
        $kategori = Kategori::where('nama', $kategoriNama)->firstOrFail();
        $query = Produk::with('kategori')->where('kategori_id', $kategori->id);
        $query = $this->applyFilters($query, $request);
        return $query->paginate(10);
    }
    
    /**
     * Menyimpan produk baru ke database.
     */
    private function storeProduk(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produks', 'public');
        }

        Produk::create($data);
    }

    /**
     * Memperbarui data produk yang ada di database.
     */
    private function updateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produks', 'public');
        }

        $produk->update($data);
    }

    /**
     * Menghapus produk beserta gambarnya.
     */
    private function deleteAndCleanProduk($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();
    }
    
    // SECTION: Makanan
    public function food(Request $request) { $foods = $this->getProdukByKategori('makanan', $request); return view('dashboard.food', compact('foods')); }
    public function createFood() { $kategoris = Kategori::all(); return view('dashboard.create.food', compact('kategoris')); }
    public function storeFood(Request $request) { $this->storeProduk($request); return redirect()->route('produk.food.index')->with('success', 'Makanan berhasil ditambahkan!'); }
    public function editFood($id) { $produk = Produk::findOrFail($id); $kategoris = Kategori::all(); return view('dashboard.edit.food', compact('produk', 'kategoris')); }
    public function updateFood(Request $request, $id) { $this->updateProduk($request, $id); return redirect()->route('produk.food.index')->with('success', 'Data makanan berhasil diperbarui!'); }
    public function deleteFood($id) { $this->deleteAndCleanProduk($id); return redirect()->route('produk.food.index')->with('success', 'Makanan berhasil dihapus!'); }

    // SECTION: Minuman
    public function drink(Request $request) { $drinks = $this->getProdukByKategori('minuman', $request); return view('dashboard.drink', compact('drinks')); }
    public function createDrink() { $kategoris = Kategori::all(); return view('dashboard.create.drink', compact('kategoris')); }
    public function storeDrink(Request $request) { $this->storeProduk($request); return redirect()->route('produk.drink.index')->with('success', 'Minuman berhasil ditambahkan!'); }
    public function editDrink($id) { $produk = Produk::findOrFail($id); $kategoris = Kategori::all(); return view('dashboard.edit.drink', compact('produk', 'kategoris')); }
    public function updateDrink(Request $request, $id) { $this->updateProduk($request, $id); return redirect()->route('produk.drink.index')->with('success', 'Data minuman berhasil diperbarui!'); }
    public function deleteDrink($id) { $this->deleteAndCleanProduk($id); return redirect()->route('produk.drink.index')->with('success', 'Minuman berhasil dihapus!'); }

    // SECTION: Ekspor Data
    public function exportFoodPDF() { return $this->exportPDF('makanan'); }
    public function exportFoodExcel() { return $this->exportExcel('makanan'); }
    public function exportDrinkPDF() { return $this->exportPDF('minuman'); }
    public function exportDrinkExcel() { return $this->exportExcel('minuman'); }

    private function exportPDF($kategoriNama)
    {
        $kategori = Kategori::where('nama', $kategoriNama)->firstOrFail();
        $produks = Produk::where('kategori_id', $kategori->id)->get();
        
        $pdf = PDF::loadView('exports.produk_pdf', ['produks' => $produks, 'kategori' => $kategoriNama]);
        return $pdf->download("laporan-{$kategoriNama}.pdf");
    }

    private function exportExcel($kategoriNama)
    {
        return Excel::download(new ProdukExport($kategoriNama), "laporan-{$kategoriNama}.xlsx");
    }
}
