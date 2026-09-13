<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Item;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('item')
            ->latest()
            ->get();

        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $items = Item::where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('barang_keluar.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($request->jumlah > $item->stock) {
            return back()
                ->withInput()
                ->withErrors([
                    'jumlah' => 'Jumlah barang keluar melebihi stok yang tersedia.'
                ]);
        }

        BarangKeluar::create([
            'item_id' => $request->item_id,
            'jumlah' => $request->jumlah,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
        ]);

        $item->decrement('stock', $request->jumlah);

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $items = Item::orderBy('name')->get();

        return view('barang_keluar.edit', compact('barangKeluar', 'items'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);

        $oldItem = Item::findOrFail($barangKeluar->item_id);

        // Kembalikan stok dari transaksi lama
        $oldItem->increment('stock', $barangKeluar->jumlah);

        $newItem = Item::findOrFail($request->item_id);

        // Cek stok untuk transaksi baru
        if ($request->jumlah > $newItem->stock) {
            $oldItem->decrement('stock', $barangKeluar->jumlah);

            return back()
                ->withInput()
                ->withErrors([
                    'jumlah' => 'Jumlah barang keluar melebihi stok yang tersedia.'
                ]);
        }

        $newItem->decrement('stock', $request->jumlah);

        $barangKeluar->update([
            'item_id' => $request->item_id,
            'jumlah' => $request->jumlah,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $item = Item::findOrFail($barangKeluar->item_id);

        // Kembalikan stok
        $item->increment('stock', $barangKeluar->jumlah);

        $barangKeluar->delete();

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil dihapus.');
    }
}