@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Edit Kategori</h4>
    <p class="text-muted mb-0">
        Perbarui informasi kategori barang
    </p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('categories.update', $category->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $category->name) }}"
                       required>

                @error('name')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Deskripsi
                </label>

                <textarea name="description"
                          class="form-control"
                          rows="4"
                          placeholder="Masukkan deskripsi kategori...">{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('categories.index') }}"
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