@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Tambah Kategori</h4>
    <p class="text-muted mb-0">
        Tambahkan kategori barang baru
    </p>
</div>

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            {{-- Nama Kategori --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>

                <input type="text"
                        name="name"
                        class="form-control"
                        placeholder="Contoh: Elektronik"
                        value="{{ old('name') }}"
                        required>

                @error('name')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Deskripsi --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Deskripsi
                </label>

                <textarea name="description"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan deskripsi kategori...">{{ old('description') }}</textarea>

                @error('description')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="d-flex gap-2">

                <a href="{{ route('categories.index') }}"
                    class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Simpan Kategori
                </button>

            </div>

        </form>

    </div>

</div>

@endsection