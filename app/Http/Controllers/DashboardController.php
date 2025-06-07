<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $produks = Produk::all();

        $total = Produk::count();
        $makanan = Produk::where('kategori', 'makanan')->count();
        $minuman = Produk::where('kategori', 'minuman')->count();

        $total_food_stock = Produk::where('kategori', 'makanan')->sum('stok');
        $total_drinks_stock = Produk::where('kategori', 'minuman')->sum('stok');

        $chartRaw = Produk::select('kategori')
            ->selectRaw('SUM(stok) as total_stok')
            ->groupBy('kategori')
            ->get();

        return view('dashboard.index', compact(
            'produks', 'total', 'makanan', 'minuman',
            'chartRaw', 'total_food_stock', 'total_drinks_stock'
        ));
    }

    // =======================
    // SECTION: MAKANAN
    // =======================

    public function food()
    {
        $foods = Produk::where('kategori', 'makanan')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.food', compact('foods'));
    }

    public function createFood()
    {
        return view('dashboard.create.food');
    }

    public function storeFood(Request $request)
    {
        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => 'makanan'
        ]);
        return redirect()->route('produk.food');
    }

    public function editFood($id)
    {
        $produk = Produk::findOrFail($id);
        return view('dashboard.edit.food', compact('produk'));
    }

    public function updateFood(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect()->route('produk.food');
    }

    public function deleteFood($id)
    {
        Produk::destroy($id);
        return redirect()->route('produk.food');
    }

    // =======================
    // SECTION: MINUMAN
    // =======================

    public function drink()
    {
        $drinks = Produk::where('kategori', 'minuman')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.drink', compact('drinks'));
    }

    public function createDrink()
    {
        return view('dashboard.create.drink');
    }

    public function storeDrink(Request $request)
    {
        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => 'minuman'
        ]);
        return redirect()->route('produk.drink');
    }

    public function editDrink($id)
    {
        $produk = Produk::findOrFail($id);
        return view('dashboard.edit.drink', compact('produk'));
    }

    public function updateDrink(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return redirect()->route('produk.drink');
    }

    public function deleteDrink($id)
    {
        Produk::destroy($id);
        return redirect()->route('produk.drink');
    }
}
