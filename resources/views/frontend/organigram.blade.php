<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - XTIK SMKN 2 Purwakarta</title>

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
    <link rel="stylesheet" href="{{ asset('css/organigram.css') }}">
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
                    <span class="banner-badge">STRUKTUR ORGANISASI</span>
                    <h1 class="banner-title">Kepengurusan XTIK Programming</h1>
                    <p class="banner-desc">
                        Susunan kepengurusan dan pembimbing ekstrakurikuler XTIK SMKN 2 Purwakarta yang bertugas merancang dan menjalankan program kerja.
                    </p>
                    <div class="banner-breadcrumb">
                        <a href="{{ url('/beranda') }}">Beranda</a>
                        <i class="fa-solid fa-chevron-right" style="font-size:0.75rem;"></i>
                        <span>Organigram</span>
                    </div>
                </div>
            </section>


            <!-- ================= STRUKTUR BAGAN HIRARKI ================= -->
            <section class="organigram-section-bg" style="padding: 70px 0 100px 0;">
                <div class="content-container">

                    @php
                        $findMember = function ($nameKeyword, $roleKeyword) use ($organigrams) {
                            return $organigrams->first(fn ($o) => str_contains(strtolower($o->nama), strtolower($nameKeyword)))
                                ?: $organigrams->first(fn ($o) => str_contains(strtolower($o->jabatan), strtolower($roleKeyword)));
                        };

                        $pembina = $findMember('kartika', 'pembina') ?? $organigrams->get(0);
                        $pelatih = $findMember('fitra', 'pelatih') ?? $organigrams->get(1);
                        $ketua = $findMember('ragil', 'ketua') ?? $organigrams->get(2);
                        $sekretaris = $findMember('alyssa', 'sekretaris') ?: $organigrams->first(fn ($o) => str_contains(strtolower($o->jabatan), 'sekertaris')) ?? $organigrams->get(3);
                        $bendahara = $findMember('yasmin', 'bendahara') ?? $organigrams->get(4);
                        $nayara = $findMember('nayara', 'dokumentasi') ?? $organigrams->get(5);

                        $mainIds = collect([$pembina, $pelatih, $ketua, $sekretaris, $bendahara, $nayara])->filter()->pluck('id');
                        $lainnya = $organigrams->reject(fn ($o) => $mainIds->contains($o->id));
                    @endphp

                    <!-- TIER 1: PEMBINA -->
                    <div class="organigram-tier reveal-on-scroll">
                        <div class="organigram-tier-title" style="margin-bottom: 40px;">
                            <span class="section-tag-pill">PEMBINA</span>
                        </div>

                        <div class="tier-grid-2" style="justify-content:center; max-width:340px; margin:0 auto;">
                            <!-- PEMBINA -->
                            <div class="person-card-modern">
                                <div class="person-photo-wrap">
                                    <img src="{{ $pembina && $pembina->foto ? asset($pembina->foto) : asset('image/Profil.jpg') }}" alt="{{ $pembina?->jabatan ?? 'Pembina' }}">
                                </div>
                                <span class="person-badge-role badge-pembina">{{ strtoupper($pembina?->jabatan ?? 'PEMBINA') }}</span>
                                <h3 class="person-name">{{ $pembina?->nama ?? 'Kartika, S.Kom.,Gr.' }}</h3>
                            </div>
                        </div>
                    </div>


                    <!-- TIER 2: INTI -->
                    <div class="organigram-tier reveal-on-scroll organigram-tier-mt">
                        <div class="organigram-tier-title">
                            <span class="section-tag-pill">INTI</span>
                        </div>

                        <div class="tier-grid-3" style="justify-content:center; max-width:680px; margin:0 auto;">
                            <!-- PELATIH -->
                            <div class="person-card-modern card-top-green">
                                <div class="person-photo-wrap">
                                    <img src="{{ $pelatih && $pelatih->foto ? asset($pelatih->foto) : asset('image/Logobaru.png') }}" alt="{{ $pelatih?->jabatan ?? 'Pelatih' }}">
                                </div>
                                <span class="person-badge-role badge-pelatih">{{ strtoupper($pelatih?->jabatan ?? 'PELATIH') }}</span>
                                <h3 class="person-name">{{ $pelatih?->nama ?? 'Fitra Fajar, S.Kom.' }}</h3>
                            </div>

                            <!-- KETUA -->
                            <div class="person-card-modern card-top-blue">
                                <div class="person-photo-wrap">
                                    <img src="{{ $ketua && $ketua->foto ? asset($ketua->foto) : asset('image/Logobaru.png') }}" alt="{{ $ketua?->jabatan ?? 'Ketua' }}">
                                </div>
                                <span class="person-badge-role badge-ketua">{{ strtoupper($ketua?->jabatan ?? 'KETUA EKSTRAKURIKULER') }}</span>
                                <h3 class="person-name">{{ $ketua?->nama ?? 'Ragil Agustino Ananda Suryanto' }}</h3>
                            </div>
                        </div>
                    </div>


                    <!-- TIER 3: PENGURUS -->
                    <div class="organigram-tier reveal-on-scroll organigram-tier-mt">
                        <div class="organigram-tier-title">
                            <span class="section-tag-pill">PENGURUS</span>
                        </div>

                        <div class="tier-grid-3" style="justify-content:center; max-width:1020px; margin:0 auto;">
                            <!-- SEKRETARIS -->
                            <div class="person-card-modern card-top-green">
                                <div class="person-photo-wrap">
                                    <img src="{{ $sekretaris && $sekretaris->foto ? asset($sekretaris->foto) : asset('image/Logobaru.png') }}" alt="{{ $sekretaris?->jabatan ?? 'Sekretaris' }}">
                                </div>
                                <span class="person-badge-role badge-sekretaris">{{ strtoupper($sekretaris?->jabatan ?? 'SEKRETARIS') }}</span>
                                <h3 class="person-name">{{ $sekretaris?->nama ?? 'Alyssa Sri Nurdewi' }}</h3>
                            </div>

                            <!-- BENDAHARA -->
                            <div class="person-card-modern card-top-amber">
                                <div class="person-photo-wrap">
                                    <img src="{{ $bendahara && $bendahara->foto ? asset($bendahara->foto) : asset('image/Logobaru.png') }}" alt="{{ $bendahara?->jabatan ?? 'Bendahara' }}">
                                </div>
                                <span class="person-badge-role badge-bendahara">{{ strtoupper($bendahara?->jabatan ?? 'BENDAHARA') }}</span>
                                <h3 class="person-name">{{ $bendahara?->nama ?? 'Yasmin Kamila Dewi' }}</h3>
                            </div>

                            <!-- DOKUMENTASI -->
                            <div class="person-card-modern card-top-purple">
                                <div class="person-photo-wrap">
                                    <img src="{{ $nayara && $nayara->foto ? asset($nayara->foto) : asset('image/Logobaru.png') }}" alt="{{ $nayara?->jabatan ?? 'Dokumentasi' }}">
                                </div>
                                <span class="person-badge-role badge-dokumentasi">{{ strtoupper($nayara?->jabatan ?? 'DOKUMENTASI') }}</span>
                                <h3 class="person-name">{{ $nayara?->nama ?? 'Nayara Khansa Zenina' }}</h3>
                            </div>

                            <!-- ANGGOTA / JABATAN LAINNYA -->
                            @foreach ($lainnya as $item)
                                <div class="person-card-modern card-top-sky">
                                    <div class="person-photo-wrap">
                                        <img src="{{ $item->foto ? asset($item->foto) : asset('image/Logobaru.png') }}" alt="{{ $item->jabatan }}">
                                    </div>
                                    <span class="person-badge-role badge-lainnya">{{ strtoupper($item->jabatan) }}</span>
                                    <h3 class="person-name">{{ $item->nama }}</h3>
                                </div>
                            @endforeach
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
