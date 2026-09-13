@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Riwayat Transaksi</h4>
    <p class="text-muted mb-0">
        Riwayat seluruh barang masuk dan barang keluar
    </p>
</div>

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($riwayat as $data)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $data['tanggal'] }}
                            </td>

                            <td>

                                @if($data['jenis'] === 'Masuk')

                                    <span class="badge bg-success">
                                        Masuk
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Keluar
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $data['kode'] }}
                            </td>

                            <td>
                                {{ $data['nama'] }}
                            </td>

                            <td>

                                @if($data['jenis'] === 'Masuk')

                                    <span class="text-success fw-semibold">
                                        +{{ $data['jumlah'] }}
                                    </span>

                                @else

                                    <span class="text-danger fw-semibold">
                                        -{{ $data['jumlah'] }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $data['keterangan'] ?: '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="text-center py-5 text-muted">
                                Belum ada riwayat transaksi.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection