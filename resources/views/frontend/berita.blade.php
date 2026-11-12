<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Publikasi - XTIK SMKN 2 Purwakarta</title>

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
                    <span class="banner-badge">kabar</span>
                    <h1 class="banner-title">Berita & Publikasi XTIK</h1>
                    <p class="banner-desc">
                        Informasi terbaru seputar kegiatan pelatihan, kejuaraan, pengumuman, dan artikel teknologi dari ekstrakurikuler XTIK Programming.
                    </p>
                    <div class="banner-breadcrumb">
                        <a href="{{ url('/beranda') }}">Beranda</a>
                        <i class="fa-solid fa-chevron-right" style="font-size:0.75rem;"></i>
                        <span>Berita</span>
                    </div>
                </div>
            </section>


            <!-- ================= CONTENT & FILTER ================= -->
            <section style="padding:60px 0 90px 0; background:#ffffff;">
                <div class="content-container">

                    <!-- FILTER BAR & SEARCH -->
                    <div class="filter-bar-wrapper reveal-on-scroll" style="justify-content: flex-start;">
                        <!-- SEARCH FORM -->
                        <form method="GET" action="{{ route('berita') }}" class="search-input-group" style="width: 100%; max-width: 400px;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul berita...">
                            <button type="submit" style="display:none;"></button>
                            @if (request()->filled('cari'))
                                <a href="{{ route('berita') }}" style="position:absolute; right:12px; color:#94a3b8; text-decoration:none; font-size:0.9rem;" title="Reset">&times;</a>
                            @endif
                        </form>
                    </div>

                    <!-- BERITA GRID -->
                    <div class="news-grid">
                        @forelse ($beritas as $item)
                            <article class="news-card reveal-on-scroll">
                                <div class="news-thumb">
                                    <img src="{{ asset($item->foto ?: 'image/beranda.jpg') }}" alt="{{ $item->judul }}" loading="lazy">
                                </div>
                                <div class="news-details">
                                    <span class="news-meta">
                                        <i class="fa-regular fa-calendar"></i> {{ $item->tanggal ? $item->tanggal->translatedFormat('d F Y') : '-' }}
                                    </span>
                                    <h2 class="news-title">{{ $item->judul }}</h2>
                                    <p class="news-excerpt">{{ \Illuminate\Support\Str::limit($item->deskripsi ?? $item->isi, 120) }}</p>
                                </div>
                            </article>
                        @empty
                            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; background:#f8fafc; border-radius:16px; border:1px dashed #cbd5e1;">
                                <i class="fa-regular fa-folder-open" style="font-size:3rem; color:#94a3b8; margin-bottom:12px; display:block;"></i>
                                <h3 style="color:#334155; font-size:1.2rem; margin-bottom:6px;">Tidak Ada Berita Ditemukan</h3>
                                <p style="color:#64748b; font-size:0.92rem; margin-bottom:16px;">Belum ada artikel berita yang cocok dengan kriteria pencarian atau kategori ini.</p>
                                <a href="{{ route('berita') }}" class="btn-primary" style="padding:9px 20px; font-size:0.88rem;">
                                    <span>Reset Semua Filter</span>
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- PAGINATION -->
                    <div style="margin-top:40px;">
                        {{ $beritas->links() }}
                    </div>

                </div>
            </section>

        </main>

        <!-- ================= MODERN FOOTER ================= -->
        @include('layouts.frontend_footer')

    </div>

</body>
</html>
