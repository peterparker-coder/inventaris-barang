<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DashboardController;



Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->except(['show']);

Route::resource('items', ItemController::class);

Route::resource('barang-masuk', BarangMasukController::class)
    ->except(['show']);

    Route::resource('barang-keluar', BarangKeluarController::class)
    ->except(['show']);

    Route::get('/riwayat', [RiwayatController::class, 'index'])
    ->name('riwayat.index');