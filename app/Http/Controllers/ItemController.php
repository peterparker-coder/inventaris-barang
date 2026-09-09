<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->latest()->get();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:255|unique:items,code',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:100',
            'condition' => 'required|in:baik,rusak ringan,rusak berat',
            'description' => 'nullable|string',
        ]);

        Item::create([
            'category_id' => $request->category_id,
            'code' => $request->code,
            'name' => $request->name,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'condition' => $request->condition,
            'description' => $request->description,
        ]);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $item = Item::with('category')->findOrFail($id);

        return view('items.show', compact('item'));
    }

    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:255|unique:items,code,' . $item->id,
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:100',
            'condition' => 'required|in:baik,rusak ringan,rusak berat',
            'description' => 'nullable|string',
        ]);

        $item->update([
            'category_id' => $request->category_id,
            'code' => $request->code,
            'name' => $request->name,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'condition' => $request->condition,
            'description' => $request->description,
        ]);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}