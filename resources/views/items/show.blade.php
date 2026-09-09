@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="fw-bold mb-1">Detail Barang</h4>
        <p class="text-muted mb-0">
            Informasi lengkap barang inventaris
        </p>
    </div>

    <a href="{{ route('items.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <div class="row">

            <div class="col-md-6 mb-4">

                <small class="text-muted">
                    Kode Barang
                </small>

                <div class="fw-semibold fs-5">
                    {{ $item->code }}
                </div>

            </div>


            <div class="col-md-6 mb-4">

                <small class="text-muted">
                    Nama Barang
                </small>

                <div class="fw-semibold fs-5">
                    {{ $item->name }}
                </div>

            </div>


            <div class="col-md-6 mb-4">

                <small class="text-muted">
                    Kategori
                </small>

                <div class="fw-semibold">
                    {{ $item->category->name }}
                </div>

            </div>


            <div class="col-md-3 mb-4">

                <small class="text-muted">
                    Stok
                </small>

                <div class="fw-semibold">
                    {{ $item->stock }}
                </div>

            </div>


            <div class="col-md-3 mb-4">

                <small class="text-muted">
                    Satuan
                </small>

                <div class="fw-semibold">
                    {{ $item->unit }}
                </div>

            </div>


            <div class="col-md-6 mb-4">

                <small class="text-muted">
                    Kondisi
                </small>

                <div class="mt-1">

                    @if($item->condition == 'baik')

                        <span class="badge bg-success">
                            Baik
                        </span>

                    @elseif($item->condition == 'rusak ringan')

                        <span class="badge bg-warning text-dark">
                            Rusak Ringan
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Rusak Berat
                        </span>

                    @endif

                </div>

            </div>


            <div class="col-12">

                <small class="text-muted">
                    Deskripsi
                </small>

                <div class="mt-1">
                    {{ $item->description ?? '-' }}
                </div>

            </div>

        </div>


        <hr class="my-4">


        <div class="d-flex gap-2">

            <a href="{{ route('items.edit', $item->id) }}"
               class="btn btn-warning">
                Edit Barang
            </a>

            <form action="{{ route('items.destroy', $item->id) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger"
                        onclick="return confirm('Yakin ingin menghapus barang ini?')">
                    Hapus Barang
                </button>

            </form>

        </div>

    </div>

</div>

@endsection