@extends('layouts.app')

@section('title', 'Tambah Barang Keluar')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Tambah Barang Keluar</h4>
    <p class="text-muted mb-0">
        Catat barang yang keluar dari inventaris
    </p>
</div>

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <form action="{{ route('barang-keluar.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Barang
                </label>

                <select name="item_id"
                        class="form-select"
                        required>

                    <option value="">
                        -- Pilih Barang --
                    </option>

                    @foreach($items as $item)

                        <option value="{{ $item->id }}"
                            {{ old('item_id') == $item->id ? 'selected' : '' }}>

                            {{ $item->code }} - {{ $item->name }}
                            (Stok: {{ $item->stock }})

                        </option>

                    @endforeach

                </select>

                @error('item_id')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Jumlah
                    </label>

                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           min="1"
                           value="{{ old('jumlah') }}"
                           required>

                    @error('jumlah')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Tanggal Keluar
                    </label>

                    <input type="date"
                           name="tanggal_keluar"
                           class="form-control"
                           value="{{ old('tanggal_keluar', date('Y-m-d')) }}"
                           required>

                    @error('tanggal_keluar')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Keterangan
                </label>

                <textarea name="keterangan"
                          class="form-control"
                          rows="4"
                          placeholder="Contoh: Digunakan untuk kegiatan kampus">{{ old('keterangan') }}</textarea>

                @error('keterangan')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('barang-keluar.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Simpan Barang Keluar
                </button>

            </div>

        </form>

    </div>

</div>

@endsection