<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Kategori;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Membagikan data kategori ke semua view untuk sidebar dinamis
        View::composer('*', function ($view) {
            try {
                // Mengambil semua kategori KECUALI 'Makanan' dan 'Minuman'
                $dynamicKategoris = Kategori::whereNotIn('nama', ['Makanan', 'Minuman'])->get();
                $view->with('kategoris_sidebar_dynamic', $dynamicKategoris);
            } catch (\Exception $e) {
                // Menangani kasus jika tabel belum ada (misal: saat proses migrasi)
                $view->with('kategoris_sidebar_dynamic', []);
            }
        });
    }
}
