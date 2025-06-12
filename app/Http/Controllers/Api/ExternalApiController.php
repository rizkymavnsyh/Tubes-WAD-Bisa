<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExternalApiController extends Controller
{
    /**
     * Mengambil dan menampilkan resep dari TheMealDB API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function fetchRecipes(Request $request)
    {
        // Mendapatkan query pencarian dari request, default-nya adalah 'Arrabiata'
        $searchQuery = $request->input('search', 'Arrabiata');

        // Menggunakan HTTP Client Laravel untuk membuat permintaan GET ke API
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/search.php', [
            's' => $searchQuery
        ]);

        $recipes = [];
        // Memeriksa apakah permintaan berhasil dan mendapatkan data JSON
        if ($response->successful()) {
            $recipes = $response->json()['meals'];
        }

        // Mengirimkan data resep ke view
        return view('external.recipes', [
            'recipes' => $recipes,
            'searchQuery' => $searchQuery
        ]);
    }
}
