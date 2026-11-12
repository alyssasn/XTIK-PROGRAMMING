<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - XTIK Programming SMKN 2 Purwakarta</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/Logobaru.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/organigram.css') }}">
</head>
<body>

    <div class="site-wrapper">

        <!-- ================= FLOATING PILL NAVBAR ================= -->
        @include('layouts.frontend_nav')

        <!-- MAIN PAGE CONTENT -->
        <main class="page-body">

            <!-- ================= HERO SECTION ================= -->
            <section class="hero-figma">
                <div class="hero-overlay"></div>

                <div class="hero-glass-container">
                    <div class="hero-glass-card reveal-on-scroll">
                        <div class="card-header-badge">
                            <span class="banner-badge">SMKN 2 PURWAKARTA</span>
                            <h1 class="card-title-main">
                                EKSTRAKURIKULER XTIK<br>
                                BIDANG PROGRAMMING
                            </h1>
                        </div>

                        <div class="card-columns">
                            <!-- VISI -->
                            <div class="card-col visi-col">
                                <h2 class="serif-title">VISI</h2>
                                <p class="col-body">
                                    {!! nl2br(e(!empty($profil?->visi) ? $profil->visi : 'Menjadikan XTIK Programming sebagai wadah bagi siswa untuk mengembangkan kemampuan di bidang pemrogramman dan teknologi, serta menciptakan generasi yang kreatif, inovasi, dan mampu menghasilkan karya digital yang bermanfaat.')) !!}
                                </p>
                            </div>

                            <!-- MISI -->
                            <div class="card-col misi-col">
                                <h2 class="serif-title">MISI</h2>
                                <p class="col-body">
                                    {!! nl2br(e(!empty($profil?->misi) ? $profil->misi : "Meningkatkan pengetahuan dan keterampilan siswa dalam bidang pemrogramman dan teknologi.\nMengembangkan kreativitas dan kemampuan program solving melalui kegiatan programming.\nMendorong anggota untuk menghasilkan karya digital yang inovasi dan bermanfaat.\nMembangun lingkungan belajar yang aktif, kolaborasi, dan menyenangkan bagi seluruh anggota.\nMengenalkan pengembangan teknologi yang relevan dengan kebutuhan masa kini.")) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </section>


            <!-- ================= TENTANG KAMI ================= -->
            <section id="tentang-kami" class="section-intro">
                <div class="content-container">
                    <div class="intro-grid">

                        <div class="intro-text-side reveal-on-scroll">
                            <div class="section-tag">
                                <span class="tag-line"></span>
                                <span class="tag-text">TENTANG KAMI</span>
                            </div>
                            <h2 class="section-title">Tempat Inovasi & Karya Nyata</h2>
                            <h3 class="section-subtitle" style="color:var(--primary-blue); font-weight:700;">
                                {{ $profil?->judul ?? 'XTIK PROGRAMMING SMKN 2 PURWAKARTA' }}
                            </h3>
                            <p class="section-desc">
                                {{ $profil?->deskripsi ?? 'XTIK bidang Programming ini adalah ekstrakurikuler di bidang teknologi informasi, khususnya pemrograman. Kami berkomitmen untuk mengembangkan kemampuan anggota melalui pembelajaran, praktik terstruktur, dan project nyata.' }}
                            </p>
                            @if (!empty($profil?->deskripsi_bawah) && !str_contains(strtolower($profil->deskripsi_bawah), 'bergabung'))
                            <p class="section-desc">
                                {{ $profil->deskripsi_bawah }}
                            </p>
                            @endif

                        </div>

                        <div class="intro-image-side reveal-on-scroll">
                            <div class="laptop-frame-wrapper">
                                <img src="{{ asset($profil?->gambar_utama ?: 'image/laptop.png') }}"
                                     alt="XTIK Programming Laptop SMKN 2 Purwakarta"
                                     class="intro-img"
                                     style="max-width: 360px;">
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <!-- ================= FOKUS PEMBELAJARAN ================= -->
            <section class="section-learning">
                <div class="content-container">
                    <div class="section-heading-center reveal-on-scroll">
                        <span class="section-tag-pill">KURIKULUM UNGGULAN</span>
                        <h2 class="section-title-center">Materi & Bidang Pembelajaran</h2>
                        <p class="section-subtitle-center">
                            Materi disesuaikan dengan kebutuhan industri teknologi informasi modern untuk memperkuat fondasi kejuruan siswa SMKN 2 Purwakarta.
                        </p>
                    </div>

                    <div class="learning-cards">
                        <div class="learning-card blue reveal-on-scroll">
                            <div class="learning-icon-box blue-box">
                                <i class="fa-solid fa-code"></i>
                            </div>
                            <h3>Dasar Pemrogramman</h3>
                            <p>Mempelajari logika pemrograman, variabel, percabangan, perulangan, dan fungsi.</p>
                        </div>
                        <div class="learning-card green reveal-on-scroll">
                            <div class="learning-icon-box green-box">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <h3>Web Development</h3>
                            <p>Belajar membuat dan mengembangkan website menggunakan HTML, CSS.</p>
                        </div>
                        <div class="learning-card orange reveal-on-scroll">
                            <div class="learning-icon-box orange-box">
                                <i class="fa-brands fa-js"></i>
                            </div>
                            <h3>JavaScript</h3>
                            <p>Mempelajari dasar JavaScript untuk membuat halaman web lebih interaktif dan dinamis.</p>
                        </div>
                        <div class="learning-card purple reveal-on-scroll">
                            <div class="learning-icon-box purple-box">
                                <i class="fa-solid fa-puzzle-piece"></i>
                            </div>
                            <h3>Problem Solving</h3>
                            <p>Melatih kemampuan berpikir logis dan mencari solusi ketika menemukan masalah dalam coding.</p>
                        </div>
                    </div>
                </div>
            </section>


            <!-- ================= BERITA TERBARU ================= -->
            <section class="section-news">
                <div class="content-container">
                    <div class="section-header-flex reveal-on-scroll">
                        <div>
                            <span class="section-tag-pill">KABAR TERKINI</span>
                            <h2 class="section-title">Berita & Publikasi Terbaru</h2>
                            <p class="section-subtitle">Dokumentasi kegiatan pelatihan, perlombaan, dan kabar prestasi ekskul.</p>
                        </div>
                    </div>

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
                                    <h3 class="news-title">{{ $item->judul }}</h3>
                                    <p class="news-excerpt">{{ \Illuminate\Support\Str::limit($item->deskripsi ?? $item->isi, 115) }}</p>
                                    <a href="{{ url('/berita') }}" class="news-link">
                                        Baca Selengkapnya <i class="fa-solid fa-chevron-right"></i>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div style="grid-column: 1/-1; text-align:center; padding:50px; background:#f8fafc; border-radius:16px;">
                                <p style="color:#64748b;">Belum ada berita terpublikasi.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>


            <!-- ================= AGENDA TERDEKAT ================= -->
            <section class="section-agenda">
                <div class="content-container">
                    <div class="section-header-flex reveal-on-scroll">
                        <div>
                            <span class="section-tag-pill">JADWAL KITA</span>
                            <h2 class="section-title">Agenda & Kegiatan Mendatang</h2>
                            <p class="section-subtitle">Catat jadwal kegiatan rutin, workshop, dan event penting XTIK Programming.</p>
                        </div>
                    </div>

                    <div class="agenda-grid">
                        @forelse ($agendas as $item)
                            <div class="agenda-item-card reveal-on-scroll">
                                <div class="agenda-calendar-pill">
                                    <span class="cal-day">{{ $item->tanggal ? $item->tanggal->format('d') : '01' }}</span>
                                    <span class="cal-month">{{ $item->tanggal ? strtoupper($item->tanggal->translatedFormat('M')) : 'JAN' }}</span>
                                    <span class="cal-year">{{ $item->tanggal ? $item->tanggal->format('Y') : date('Y') }}</span>
                                </div>
                                <div class="agenda-info" style="flex:1;">
                                    <h3>{{ $item->judul }}</h3>
                                    <span class="agenda-time" style="margin-top: 8px;">
                                        <i class="fa-solid fa-location-dot" style="color:#ef4444;"></i> Lab Komputer SMKN 2
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div style="grid-column: 1/-1; text-align:center; padding:50px; background:#ffffff; border-radius:16px;">
                                <p style="color:#64748b;">Belum ada agenda terdaftar.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>




        </main>

        <!-- ================= MODERN FOOTER ================= -->
        @include('layouts.frontend_footer')

    </div>

</body>
</html>