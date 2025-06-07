<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;  // Import ProdukController!

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('produk', ProdukController::class);
Route::get('/food', [DashboardController::class, 'food'])->name('produk.food');
Route::get('/drink', [DashboardController::class, 'drink'])->name('produk.drink');

Route::get('/food/create', [DashboardController::class, 'createFood'])->name('produk.food.create');
Route::post('/food/store', [DashboardController::class, 'storeFood'])->name('produk.food.store');
Route::get('/food/{id}/edit', [DashboardController::class, 'editFood'])->name('produk.food.edit');
Route::put('/food/{id}', [DashboardController::class, 'updateFood'])->name('produk.food.update');
Route::delete('/food/{id}', [DashboardController::class, 'deleteFood'])->name('produk.food.delete');

Route::get('/drink/create', [DashboardController::class, 'createDrink'])->name('produk.drink.create');
Route::post('/drink/store', [DashboardController::class, 'storeDrink'])->name('produk.drink.store');
Route::get('/drink/{id}/edit', [DashboardController::class, 'editDrink'])->name('produk.drink.edit');
Route::put('/drink/{id}', [DashboardController::class, 'updateDrink'])->name('produk.drink.update');
Route::delete('/drink/{id}', [DashboardController::class, 'deleteDrink'])->name('produk.drink.delete');