@extends('layouts.app')

@section('title', 'Edit Barang Masuk')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Edit Barang Masuk</h4>
    <p class="text-muted mb-0">
        Perbarui catatan barang masuk
    </p>
</div>

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <form action="{{ route('barang-masuk.update', $barangMasuk->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Barang
                </label>

                <select name="item_id"
                        class="form-select"
                        required>

                    @foreach($items as $item)

                        <option value="{{ $item->id }}"
                            {{ old('item_id', $barangMasuk->item_id) == $item->id ? 'selected' : '' }}>

                            {{ $item->code }} - {{ $item->name }}

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
                           value="{{ old('jumlah', $barangMasuk->jumlah) }}"
                           required>

                    @error('jumlah')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Tanggal Masuk
                    </label>

                    <input type="date"
                           name="tanggal_masuk"
                           class="form-control"
                           value="{{ old('tanggal_masuk', $barangMasuk->tanggal_masuk) }}"
                           required>

                    @error('tanggal_masuk')
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
                          placeholder="Masukkan keterangan...">{{ old('keterangan', $barangMasuk->keterangan) }}</textarea>

                @error('keterangan')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('barang-masuk.index') }}"
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