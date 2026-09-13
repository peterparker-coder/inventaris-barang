@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="fw-bold mb-1">Barang Keluar</h4>
        <p class="text-muted mb-0">
            Catatan barang yang keluar dari inventaris
        </p>
    </div>

    <a href="{{ route('barang-keluar.create') }}"
       class="btn btn-primary">
        + Tambah Barang Keluar
    </a>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($barangKeluar as $data)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $data->tanggal_keluar }}</td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $data->item->code }}
                                </span>
                            </td>

                            <td>{{ $data->item->name }}</td>

                            <td>
                                <span class="badge bg-danger">
                                    -{{ $data->jumlah }}
                                </span>
                            </td>

                            <td>
                                {{ $data->keterangan ?: '-' }}
                            </td>

                            <td>

                                <a href="{{ route('barang-keluar.edit', $data->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('barang-keluar.destroy', $data->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data barang keluar ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="text-center py-5 text-muted">
                                Belum ada data barang keluar.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection