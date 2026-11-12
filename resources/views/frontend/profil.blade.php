<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Ekstrakurikuler - XTIK SMKN 2 Purwakarta</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/Logobaru.png') }}">

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
                    <span class="banner-badge">TENTANG KAMI</span>
                    <h1 class="banner-title">Profil XTIK Programming</h1>
                    <p class="banner-desc">
                        Mengenal lebih dekat visi, misi, kurikulum, serta komitmen kami dalam mencetak talenta teknologi berintegritas di SMKN 2 Purwakarta.
                    </p>
                    <div class="banner-breadcrumb">
                        <a href="{{ url('/beranda') }}">Beranda</a>
                        <i class="fa-solid fa-chevron-right" style="font-size:0.75rem;"></i>
                        <span>Profil</span>
                    </div>
                </div>
            </section>


            <!-- ================= SECTION TENTANG KAMI ================= -->
            <section class="section-intro">
                <div class="content-container">
                    <div class="intro-grid">

                        <div class="intro-text-side reveal-on-scroll">
                            <div class="section-tag">
                                <span class="tag-line"></span>
                                <span class="tag-text">TENTANG KAMI</span>
                            </div>
                            <h2 class="section-title">{{ $profil?->judul ?? 'XTIK PROGRAMMING' }}</h2>
                            <h3 class="section-subtitle" style="font-size:1.15rem; font-weight:700; color:var(--primary-blue);">SMKN 2 PURWAKARTA</h3>
                            <p class="section-desc">
                                {{ $profil?->deskripsi ?? 'XTIK bidang Programming ini adalah ekstrakurikuler di bidang teknologi informasi, khususnya pemrograman. Kami berkomitmen untuk mengembangkan kemampuan anggota melalui pembelajaran terstruktur, praktik langsung, dan proyek kolaboratif.' }}
                            </p>
                            @if (!empty($profil?->deskripsi_bawah) && !str_contains(strtolower($profil->deskripsi_bawah), 'bergabung'))
                            <p class="section-desc">
                                {{ $profil->deskripsi_bawah }}
                            </p>
                            @endif
                        </div>

                        <div class="intro-image-side reveal-on-scroll">
                            <div class="laptop-frame-wrapper">
                                @if (!empty($profil?->gambar_utama))
                                    <img src="{{ asset($profil->gambar_utama) }}" alt="XTIK Programming SMKN 2 Purwakarta" class="intro-img" style="max-width: 360px;">
                                @else
                                    <img src="{{ asset('image/laptop.png') }}" alt="Coding Laptop" class="intro-img" style="max-width: 360px;">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <!-- ================= VISI & MISI SECTION ================= -->
            <section style="padding:80px 0; background:#f8fafc;">
                <div class="content-container">

                    <div class="section-heading-center reveal-on-scroll">
                        <span class="section-tag-pill">LANDASAN & ARAH</span>
                        <h2 class="section-title-center">Visi & Misi Kami</h2>
                        <p class="section-subtitle-center">Pedoman pokok dalam menjalankan setiap program kerja dan pengembangan potensi anggota.</p>
                    </div>

                    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:32px; max-width:1100px; margin:0 auto;">

                        <!-- VISI CARD -->
                        <div class="reveal-on-scroll" style="background:#ffffff; border-radius:24px; padding:38px 34px; box-shadow:var(--card-shadow); border:1px solid var(--border-color); position:relative; overflow:hidden;">
                            <h3 style="font-size:1.4rem; font-weight:800; color:var(--primary-dark); margin-bottom:14px;">VISI</h3>
                            <div style="width:40px; height:3px; background:#0b5aa2; border-radius:2px; margin-bottom:18px;"></div>
                            <p style="color:#475569; font-size:1rem; line-height:1.8;">
                                {!! nl2br(e(!empty($profil?->visi) && $profil->visi !== '-------------' ? $profil->visi : 'Menjadikan XTIK Programming sebagai wadah bagi siswa untuk mengembangkan kemampuan di bidang pemrogramman dan teknologi, serta menciptakan generasi yang kreatif, inovasi, dan mampu menghasilkan karya digital yang bermanfaat.')) !!}
                            </p>
                        </div>

                        <!-- MISI CARD -->
                        <div class="reveal-on-scroll" style="background:#ffffff; border-radius:24px; padding:38px 34px; box-shadow:var(--card-shadow); border:1px solid var(--border-color); position:relative; overflow:hidden;">
                            <h3 style="font-size:1.4rem; font-weight:800; color:var(--primary-dark); margin-bottom:14px;">MISI</h3>
                            <div style="width:40px; height:3px; background:#16a34a; border-radius:2px; margin-bottom:18px;"></div>
                            <p style="color:#475569; font-size:1rem; line-height:1.8;">
                                {!! nl2br(e(!empty($profil?->misi) && $profil->misi !== '-------------' ? $profil->misi : "Meningkatkan pengetahuan dan keterampilan siswa dalam bidang pemrogramman dan teknologi.\nMengembangkan kreativitas dan kemampuan program solving melalui kegiatan programming.\nMendorong anggota untuk menghasilkan karya digital yang inovasi dan bermanfaat.\nMembangun lingkungan belajar yang aktif, kolaborasi, dan menyenangkan bagi seluruh anggota.\nMengenalkan pengembangan teknologi yang relevan dengan kebutuhan masa kini.")) !!}
                            </p>
                        </div>

                    </div>

                </div>
            </section>


            <!-- ================= KURIKULUM LENGKAP ================= -->
            <section class="section-learning">
                <div class="content-container">

                    <div class="section-heading-center reveal-on-scroll">
                        <span class="section-tag-pill">KURIKULUM UNGGULAN</span>
                        <h2 class="section-title-center">Materi & Bidang Pembelajaran</h2>
                        <p class="section-subtitle-center">Materi disesuaikan dengan kebutuhan industri teknologi informasi modern untuk memperkuat fondasi kejuruan siswa SMKN 2 Purwakarta.</p>
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




        </main>

        <!-- ================= MODERN FOOTER ================= -->
        @include('layouts.frontend_footer')

    </div>

</body>
</html>
