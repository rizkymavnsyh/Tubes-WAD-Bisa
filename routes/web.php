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
// RUTE MAKANAN (VERSI SEDERHANA)
// ===================================
Route::get('/food', [DashboardController::class, 'food'])->name('produk.food.index');
Route::get('/food/create', [DashboardController::class, 'createFood'])->name('produk.food.create');
Route::post('/food', [DashboardController::class, 'storeFood'])->name('produk.food.store');
Route::get('/food/{id}/edit', [DashboardController::class, 'editFood'])->name('produk.food.edit');
Route::put('/food/{id}', [DashboardController::class, 'updateFood'])->name('produk.food.update');
Route::delete('/food/{id}', [DashboardController::class, 'deleteFood'])->name('produk.food.delete');
Route::delete('/food/bulk-delete', [DashboardController::class, 'bulkDeleteFood'])->name('produk.food.bulkDelete');
Route::get('/food/export/pdf', [DashboardController::class, 'exportFoodPDF'])->name('produk.food.export.pdf');
Route::get('/food/export/excel', [DashboardController::class, 'exportFoodExcel'])->name('produk.food.export.excel');


// ===================================
// RUTE MINUMAN (VERSI SEDERHANA)
// ===================================
Route::get('/drink', [DashboardController::class, 'drink'])->name('produk.drink.index');
Route::get('/drink/create', [DashboardController::class, 'createDrink'])->name('produk.drink.create');
Route::post('/drink', [DashboardController::class, 'storeDrink'])->name('produk.drink.store');
Route::get('/drink/{id}/edit', [DashboardController::class, 'editDrink'])->name('produk.drink.edit');
Route::put('/drink/{id}', [DashboardController::class, 'updateDrink'])->name('produk.drink.update');
Route::delete('/drink/{id}', [DashboardController::class, 'deleteDrink'])->name('produk.drink.delete');
Route::delete('/drink/bulk-delete', [DashboardController::class, 'bulkDeleteDrink'])->name('produk.drink.bulkDelete');
Route::get('/drink/export/pdf', [DashboardController::class, 'exportDrinkPDF'])->name('produk.drink.export.pdf');
Route::get('/drink/export/excel', [DashboardController::class, 'exportDrinkExcel'])->name('produk.drink.export.excel');

