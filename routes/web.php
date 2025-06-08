<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;

// Rute utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Rute untuk manajemen kategori
Route::resource('kategori', KategoriController::class)->except(['show']);

// Rute untuk menampilkan detail produk
Route::get('/produk/{id}', [DashboardController::class, 'show'])->name('produk.show');

// ===================================
// RUTE MAKANAN (FOOD)
// ===================================
Route::prefix('food')->name('produk.food.')->group(function () {
    Route::get('/', [DashboardController::class, 'food'])->name('index');
    Route::get('/create', [DashboardController::class, 'createFood'])->name('create');
    Route::post('/', [DashboardController::class, 'storeFood'])->name('store');
    Route::get('/{id}/edit', [DashboardController::class, 'editFood'])->name('edit');
    Route::put('/{id}', [DashboardController::class, 'updateFood'])->name('update');
    Route::delete('/{id}', [DashboardController::class, 'deleteFood'])->name('delete');    
    Route::get('/export/pdf', [DashboardController::class, 'exportFoodPDF'])->name('export.pdf');
    Route::get('/export/excel', [DashboardController::class, 'exportFoodExcel'])->name('export.excel');
});

// ===================================
// RUTE MINUMAN (DRINK)
// ===================================
Route::prefix('drink')->name('produk.drink.')->group(function () {
    Route::get('/', [DashboardController::class, 'drink'])->name('index');
    Route::get('/create', [DashboardController::class, 'createDrink'])->name('create');
    Route::post('/', [DashboardController::class, 'storeDrink'])->name('store');
    Route::get('/{id}/edit', [DashboardController::class, 'editDrink'])->name('edit');
    Route::put('/{id}', [DashboardController::class, 'updateDrink'])->name('update');
    Route::delete('/{id}', [DashboardController::class, 'deleteDrink'])->name('delete');
    Route::get('/export/pdf', [DashboardController::class, 'exportDrinkPDF'])->name('export.pdf');
    Route::get('/export/excel', [DashboardController::class, 'exportDrinkExcel'])->name('export.excel');
});