<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class RiwayatController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('item')
            ->get()
            ->map(function ($data) {
                return [
                    'tanggal' => $data->tanggal_masuk,
                    'jenis' => 'Masuk',
                    'kode' => $data->item->code,
                    'nama' => $data->item->name,
                    'jumlah' => $data->jumlah,
                    'keterangan' => $data->keterangan,
                ];
            });

        $barangKeluar = BarangKeluar::with('item')
            ->get()
            ->map(function ($data) {
                return [
                    'tanggal' => $data->tanggal_keluar,
                    'jenis' => 'Keluar',
                    'kode' => $data->item->code,
                    'nama' => $data->item->name,
                    'jumlah' => $data->jumlah,
                    'keterangan' => $data->keterangan,
                ];
            });

        $riwayat = $barangMasuk
            ->concat($barangKeluar)
            ->sortByDesc('tanggal');

        return view('riwayat.index', compact('riwayat'));
    }
}