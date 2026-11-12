<!-- ================= FLOATING PILL NAVBAR & MOBILE MENU (GARIS 3 BUKA-TUTUP) ================= -->
<header class="header-floating">
    <div class="header-pill">

        <!-- BRAND / LOGO -->
        <a href="{{ url('/beranda') }}" class="logo-area" aria-label="XTIK Programming SMKN 2 Purwakarta">
            <div class="logo-circle">
                <img src="{{ asset('image/Logobaru.png') }}" alt="Logo XTIK SMKN 2 Purwakarta">
            </div>
            <span class="brand-text">XTIK PROGRAMMING</span>
        </a>

        <!-- DESKTOP NAV MENU -->
        <nav class="desktop-nav" aria-label="Menu Utama">
            <a href="{{ url('/beranda') }}" class="nav-item {{ request()->is('beranda') || request()->is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ url('/profil') }}" class="nav-item {{ request()->is('profil*') ? 'active' : '' }}">Profil</a>
            <a href="{{ url('/organigram') }}" class="nav-item {{ request()->is('organigram*') ? 'active' : '' }}">Organigram</a>
            <a href="{{ url('/berita') }}" class="nav-item {{ request()->is('berita*') ? 'active' : '' }}">Berita</a>
            <a href="{{ url('/anggota') }}" class="nav-item {{ request()->is('anggota*') ? 'active' : '' }}">Anggota</a>
            <a href="{{ url('/agenda') }}" class="nav-item {{ request()->is('agenda*') ? 'active' : '' }}">Agenda</a>
            <a href="{{ route('login') }}" class="nav-item nav-btn">Login</a>
        </nav>

        <!-- MOBILE HAMBURGER TOGGLE (GARIS 3 BUKA-TUTUP) -->
        <input type="checkbox" id="menu-toggle" class="menu-checkbox" aria-label="Toggle navigasi mobile">
        <label for="menu-toggle" class="menu-icon" aria-label="Buka / Tutup Menu Navigasi" title="Buka / Tutup Menu">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <!-- MOBILE DRAWER -->
        <div class="nav-menu mobile-drawer">
            <div class="drawer-header">
                <div class="drawer-logo">
                    <img src="{{ asset('image/Logobaru.png') }}" alt="Logo XTIK" style="width:32px; height:32px; object-fit:contain;">
                    <span style="font-weight:800; font-size:0.95rem; color:#0f172a;">XTIK PROGRAMMING</span>
                </div>
            </div>
            <nav class="drawer-links" aria-label="Navigasi Seluler">
                <a href="{{ url('/beranda') }}" class="drawer-link {{ request()->is('beranda') || request()->is('/') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ url('/profil') }}" class="drawer-link {{ request()->is('profil*') ? 'active' : '' }}">
                    Profil
                </a>
                <a href="{{ url('/organigram') }}" class="drawer-link {{ request()->is('organigram*') ? 'active' : '' }}">
                    Organigram
                </a>
                <a href="{{ url('/berita') }}" class="drawer-link {{ request()->is('berita*') ? 'active' : '' }}">
                    Berita
                </a>
                <a href="{{ url('/anggota') }}" class="drawer-link {{ request()->is('anggota*') ? 'active' : '' }}">
                    Anggota
                </a>
                <a href="{{ url('/agenda') }}" class="drawer-link {{ request()->is('agenda*') ? 'active' : '' }}">
                    Agenda
                </a>
                <a href="{{ route('login') }}" class="drawer-link drawer-auth">
                    Login Admin
                </a>
            </nav>
        </div>

    </div>
</header>

<!-- BACKDROP OVERLAY UNTUK MOBILE DRAWER -->
<div class="mobile-drawer-backdrop" aria-hidden="true"></div>
