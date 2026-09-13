<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Item;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('item')
            ->latest()
            ->get();

        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $items = Item::orderBy('name')->get();

        return view('barang_masuk.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        BarangMasuk::create([
            'item_id' => $request->item_id,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'keterangan' => $request->keterangan,
        ]);

        $item = Item::findOrFail($request->item_id);
        $item->increment('stock', $request->jumlah);

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $barangMasuk = BarangMasuk::with('item')->findOrFail($id);

        return view('barang_masuk.show', compact('barangMasuk'));
    }

    public function edit(string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $items = Item::orderBy('name')->get();

        return view('barang_masuk.edit', compact('barangMasuk', 'items'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        // Kembalikan stok dari jumlah lama
        $oldItem = Item::findOrFail($barangMasuk->item_id);
        $oldItem->decrement('stock', $barangMasuk->jumlah);

        // Tambahkan stok berdasarkan data baru
        $newItem = Item::findOrFail($request->item_id);
        $newItem->increment('stock', $request->jumlah);

        $barangMasuk->update([
            'item_id' => $request->item_id,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $item = Item::findOrFail($barangMasuk->item_id);
        $item->decrement('stock', $barangMasuk->jumlah);

        $barangMasuk->delete();

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil dihapus.');
    }
}