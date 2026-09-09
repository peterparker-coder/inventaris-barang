@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Data Barang</h4>
        <p class="text-muted mb-0">
            Kelola seluruh barang inventaris
        </p>
    </div>

    <a href="{{ route('items.create') }}" class="btn btn-primary">
        + Tambah Barang
    </a>
</div>


<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($items as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $item->code }}
                                </span>
                            </td>

                            <td>
                                {{ $item->name }}
                            </td>

                            <td>
                                {{ $item->category->name }}
                            </td>

                            <td>
                                {{ $item->stock }}
                            </td>

                            <td>
                                {{ $item->unit }}
                            </td>

                            <td>

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

                            </td>

                            <td>

                                <a href="{{ route('items.show', $item->id) }}"
                                   class="btn btn-sm btn-info text-white">
                                    Detail
                                </a>

                                <a href="{{ route('items.edit', $item->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('items.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8"
                                class="text-center py-5 text-muted">

                                Belum ada data barang.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection