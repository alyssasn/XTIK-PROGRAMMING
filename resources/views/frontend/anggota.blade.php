<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota - XTIK Programming SMKN 2 Purwakarta</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/Logobaru.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">
</head>
<body>

    <div class="site-wrapper">

        <!-- ================= FLOATING PILL NAVBAR ================= -->
        @include('layouts.frontend_nav')

        <!-- MAIN PAGE CONTENT -->
        <main class="page-body">

            <!-- ================= SUBPAGE HERO BANNER ================= -->
            <section class="subpage-banner">
                <div class="subpage-banner-content reveal-on-scroll">
                    <span class="banner-badge">ANGGOTA AKTIF</span>
                    <h1 class="banner-title">Daftar Anggota XTIK Programming</h1>
                    <p class="banner-desc">
                        Siswa-siswi berdedikasi SMKN 2 Purwakarta yang aktif mengasah keahlian pemrograman, logika komputasi, dan rekayasa perangkat lunak.
                    </p>
                    <div class="banner-breadcrumb">
                        <a href="{{ url('/beranda') }}">Beranda</a>
                        <i class="fa-solid fa-chevron-right" style="font-size:0.75rem;"></i>
                        <span>Anggota</span>
                    </div>
                </div>
            </section>


            <!-- ================= CONTENT & FILTER ================= -->
            <section style="padding:60px 0 90px 0; background:#ffffff;">
                <div class="content-container">

                    <!-- FILTER & SEARCH BAR -->
                    <div class="filter-bar-wrapper reveal-on-scroll" style="justify-content: flex-start;">

                        <!-- SEARCH -->
                        <form method="GET" action="{{ route('anggota') }}" class="search-input-group" style="width: 100%; max-width: 400px;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama siswa...">
                            <button type="submit" style="display:none;"></button>
                            @if (request()->filled('cari') || request()->filled('kelas') || request()->filled('jurusan'))
                                <a href="{{ route('anggota') }}" style="position:absolute; right:12px; color:#94a3b8; text-decoration:none; font-size:1rem;" title="Reset Filter">&times;</a>
                            @endif
                        </form>

                    </div>



                    <!-- TABLE ANGGOTA -->
                    <div class="table-card-wrapper reveal-on-scroll">
                        <div class="table-responsive">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th style="width:60px; text-align:center;">No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th style="text-align:center;">Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($anggotas as $index => $item)
                                        <tr>
                                            <td style="text-align:center; color:#64748b; font-weight:600;">
                                                {{ $loop->iteration + ($anggotas->currentPage() - 1) * $anggotas->perPage() }}.
                                            </td>
                                            <td>
                                                <div style="display:flex; align-items:center;">
                                                    @php
                                                        $initials = collect(explode(' ', $item->nama))->take(2)->map(fn($w) => mb_substr($w, 0, 1))->implode('');
                                                    @endphp
                                                    <div class="student-badge-initials">
                                                        {{ strtoupper($initials) }}
                                                    </div>
                                                    <div>
                                                        <strong style="display:block; color:#0f172a; font-size:0.95rem;">{{ $item->nama }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge-tag-class">
                                                    {{ $item->kelas }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge-tag-major">
                                                    {{ $item->jurusan }}
                                                </span>
                                            </td>
                                            <td style="text-align:center;">
                                                @if (strtolower($item->jenis_kelamin) == 'perempuan')
                                                    <span class="badge-gender-perempuan">
                                                        <i class="fa-solid fa-venus"></i> Perempuan
                                                    </span>
                                                @else
                                                    <span class="badge-gender-laki">
                                                        <i class="fa-solid fa-mars"></i> Laki-laki
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center; padding:60px 20px;">
                                                <i class="fa-regular fa-user-slash" style="font-size:3rem; color:#cbd5e1; margin-bottom:12px; display:block;"></i>
                                                <h3 style="color:#334155; font-size:1.2rem; margin-bottom:6px;">Tidak Ada Anggota Ditemukan</h3>
                                                <p style="color:#64748b; font-size:0.92rem; margin-bottom:16px;">
                                                    Tidak ada data anggota yang cocok dengan filter pencarian Anda.
                                                </p>
                                                <a href="{{ route('anggota') }}" class="btn-primary" style="padding:8px 20px; font-size:0.88rem;">
                                                    Reset Filter
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- PAGINATION -->
                    <div style="margin-top:24px;">
                        {{ $anggotas->links('partials.pagination_custom') }}
                    </div>

                </div>
            </section>

        </main>

        <!-- ================= MODERN FOOTER ================= -->
        @include('layouts.frontend_footer')

    </div>

</body>
</html>