<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = Category::count();
        $totalBarang = Item::count();
        $totalStok = Item::sum('stock');
        $totalBarangMasuk = BarangMasuk::sum('jumlah');
        $totalBarangKeluar = BarangKeluar::sum('jumlah');

        $transaksiTerbaru = collect()
            ->merge(
                BarangMasuk::with('item')
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($data) {
                        return [
                            'tanggal' => $data->tanggal_masuk,
                            'jenis' => 'Masuk',
                            'kode' => $data->item->code,
                            'nama' => $data->item->name,
                            'jumlah' => $data->jumlah,
                        ];
                    })
            )
            ->merge(
                BarangKeluar::with('item')
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($data) {
                        return [
                            'tanggal' => $data->tanggal_keluar,
                            'jenis' => 'Keluar',
                            'kode' => $data->item->code,
                            'nama' => $data->item->name,
                            'jumlah' => $data->jumlah,
                        ];
                    })
            )
            ->sortByDesc('tanggal')
            ->take(5);

        return view('dashboard', compact(
            'totalKategori',
            'totalBarang',
            'totalStok',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'transaksiTerbaru'
        ));
    }
}