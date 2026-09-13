<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Inventaris Barang')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="d-flex min-vh-100">

    <!-- SIDEBAR -->
    <aside class="bg-dark text-white" style="width: 240px;">

        <div class="p-4 border-bottom border-secondary">
            <h4 class="fw-bold mb-1">Inventaris</h4>
            <small class="text-secondary">
                Sistem Pengelolaan Barang
            </small>
        </div>

        <div class="p-3">

            <small class="text-secondary px-2">
                MENU UTAMA
            </small>

            <div class="nav flex-column mt-2">

                <a href="{{ route('categories.index') }}"
                    class="nav-link text-white rounded py-2 px-3 mb-1">
                    Kategori Barang
                </a>

                <a href="{{ route('items.index') }}"
                    class="nav-link text-white rounded py-2 px-3 mb-1">
                    Data Barang
                </a>

                <a href="{{ route('barang-masuk.index') }}"
                    class="nav-link text-white rounded py-2 px-3 mb-1">
                    Barang Masuk
                </a>

                <a href="{{ route('barang-keluar.index') }}"
                    class="nav-link text-white rounded py-2 px-3 mb-1">
                    Barang Keluar
                </a>

                <a href="#"
                    class="nav-link text-white rounded py-2 px-3">
                    Riwayat
                </a>

            </div>

        </div>

    </aside>


    <!-- AREA UTAMA -->
    <main class="flex-grow-1">

        <!-- HEADER -->
        <header class="bg-white border-bottom px-4 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="fw-bold mb-0">
                        @yield('title', 'Dashboard')
                    </h5>

                    <small class="text-muted">
                        Sistem Inventaris Barang
                    </small>
                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <section class="p-4">

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            @yield('content')

        </section>

    </main>

</div>

</body>
</html>