<!-- TOGGLE SIDEBAR CHECKBOX -->
<input type="checkbox" id="sidebar-toggle" style="display:none;">

<!-- ====== ADMIN HEADER ====== -->
<header class="admin-header">
    <div class="header-left">
        <!-- TOMBOL GARIS 3 (HAMBURGER / TOGGLE SIDEBAR BUKA-TUTUP) -->
        <button type="button" id="sidebarToggleBtn" class="menu-icon" aria-label="Buka / Tutup Sidebar" title="Buka / Tutup Sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- LOGO BRAND -->
        <a href="{{ route('backend.dashboard') }}" class="header-logo-link">
            <div class="header-logo">
                <img src="{{ asset('image/Logobaru.png') }}" alt="Logo XTIK">
            </div>
            <div class="header-brand">
                <h1>XTIK - PROGRAMMING</h1>
                <p>SMKN 2 PURWAKARTA</p>
            </div>
        </a>
    </div>

    <!-- HEADER RIGHT -->
    <div class="header-right-area">
        <a href="{{ url('/beranda') }}" class="btn-view-web" title="Lihat Website">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Lihat Website</span>
        </a>

        <!-- ADMIN PROFILE BADGE -->
        <div class="admin-profile-badge">
            <i class="fa-solid fa-circle-user profile-user-icon"></i>
            <span class="profile-user-name">Administration</span>
        </div>
    </div>
</header>
