@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Dashboard</h4>
    <p class="text-muted mb-0">
        Ringkasan sistem inventaris barang
    </p>
</div>

<div class="row g-4 mb-4">

    <div class="col-md-4 col-lg">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Total Kategori</p>
                <h3 class="fw-bold mb-0">{{ $totalKategori }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Jenis Barang</p>
                <h3 class="fw-bold mb-0">{{ $totalBarang }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Total Stok</p>
                <h3 class="fw-bold mb-0">{{ $totalStok }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Barang Masuk</p>
                <h3 class="fw-bold text-success mb-0">
                    +{{ $totalBarangMasuk }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Barang Keluar</p>
                <h3 class="fw-bold text-danger mb-0">
                    -{{ $totalBarangKeluar }}
                </h3>
            </div>
        </div>
    </div>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Transaksi Terbaru</h5>

            <a href="{{ route('riwayat.index') }}"
               class="btn btn-sm btn-outline-primary">
                Lihat Semua
            </a>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kode</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transaksiTerbaru as $data)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $data['tanggal'] }}</td>

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

                            <td>{{ $data['kode'] }}</td>

                            <td>{{ $data['nama'] }}</td>

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

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6"
                                class="text-center py-5 text-muted">
                                Belum ada transaksi.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection