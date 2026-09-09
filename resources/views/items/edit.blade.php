@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Edit Barang</h4>
    <p class="text-muted mb-0">
        Perbarui informasi barang inventaris
    </p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('items.update', $item->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Kode Barang
                    </label>

                    <input type="text"
                           name="code"
                           class="form-control"
                           value="{{ old('code', $item->code) }}"
                           required>

                    @error('code')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Nama Barang
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $item->name) }}"
                           required>

                    @error('name')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Kategori
                    </label>

                    <select name="category_id"
                            class="form-select"
                            required>

                        <option value="">-- Pilih Kategori --</option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">
                        Stok
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           min="0"
                           value="{{ old('stock', $item->stock) }}"
                           required>

                    @error('stock')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">
                        Satuan
                    </label>

                    <input type="text"
                           name="unit"
                           class="form-control"
                           value="{{ old('unit', $item->unit) }}"
                           required>

                    @error('unit')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Kondisi
                    </label>

                    <select name="condition"
                            class="form-select"
                            required>

                        <option value="baik"
                            {{ old('condition', $item->condition) == 'baik' ? 'selected' : '' }}>
                            Baik
                        </option>

                        <option value="rusak ringan"
                            {{ old('condition', $item->condition) == 'rusak ringan' ? 'selected' : '' }}>
                            Rusak Ringan
                        </option>

                        <option value="rusak berat"
                            {{ old('condition', $item->condition) == 'rusak berat' ? 'selected' : '' }}>
                            Rusak Berat
                        </option>

                    </select>

                    @error('condition')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              placeholder="Masukkan deskripsi barang...">{{ old('description', $item->description) }}</textarea>

                    @error('description')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('items.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
</div>

@endsection