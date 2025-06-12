<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

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
        $searchQuery = $request->input('search', 'Arrabiata');
        $recipes = [];
        $error = null;

        try {
            // Menambahkan timeout untuk mencegah waktu tunggu yang lama
            $response = Http::timeout(15)->get('https://www.themealdb.com/api/json/v1/1/search.php', [
                's' => $searchQuery
            ]);

            if ($response->successful()) {
                $recipes = $response->json()['meals'];
            } else {
                // Menangani respons yang tidak berhasil dari API
                $error = 'Gagal mengambil data dari TheMealDB. Status: ' . $response->status();
            }
        } catch (ConnectionException $e) {
            // Menangkap galat koneksi dan mengirim pesan ke view
            $error = 'Tidak dapat terhubung ke server resep. Silakan periksa koneksi internet Anda atau coba lagi nanti.';
            report($e); // Opsional: laporkan galat ke log
        }

        // Mengirimkan data atau pesan galat ke view
        return view('external.recipes', [
            'recipes' => $recipes,
            'searchQuery' => $searchQuery,
            'error' => $error
        ]);
    }

    /**
     * (METODE YANG DITAMBAHKAN)
     * Menampilkan detail lengkap dari satu resep berdasarkan ID.
     *
     * @param  string $id
     * @return \Illuminate\View\View
     */
    public function showRecipe($id)
    {
        $recipe = null;
        $error = null;

        try {
            $response = Http::timeout(15)->get('https://www.themealdb.com/api/json/v1/1/lookup.php', [
                'i' => $id
            ]);

            if ($response->successful() && !empty($response->json()['meals'])) {
                $recipe = $response->json()['meals'][0];
            } else {
                $error = 'Resep tidak ditemukan atau terjadi kesalahan saat mengambil data.';
            }
        } catch (ConnectionException $e) {
            $error = 'Tidak dapat terhubung ke server resep. Silakan periksa koneksi internet Anda atau coba lagi nanti.';
            report($e);
        }

        return view('external.show', [
            'recipe' => $recipe,
            'error' => $error
        ]);
    }
}
