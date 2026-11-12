<!-- ================= SIDEBAR ADMIN ================= -->
<aside class="sidebar">
    <h2>MENU</h2>
    <nav>
        <a href="{{ route('backend.dashboard') }}" class="sidebar-link {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Dashboard</span>
        </a>


        <a href="{{ route('backend.profil') }}" class="sidebar-link {{ request()->routeIs('backend.profil*') && !request()->routeIs('backend.profil_admin*') ? 'active' : '' }}">
            <i class="fa-solid fa-school"></i>
            <span>Profil</span>
        </a>

        <a href="{{ route('backend.organigram.index') }}" class="sidebar-link {{ request()->routeIs('backend.organigram*') ? 'active' : '' }}">
            <i class="fa-solid fa-sitemap"></i>
            <span>Organigram</span>
        </a>

        <a href="{{ route('backend.berita.index') }}" class="sidebar-link {{ request()->routeIs('backend.berita*') ? 'active' : '' }}">
            <i class="fa-regular fa-newspaper"></i>
            <span>Berita</span>
        </a>

        <a href="{{ route('backend.anggota.index') }}" class="sidebar-link {{ request()->routeIs('backend.anggota*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-group"></i>
            <span>Anggota</span>
        </a>

        <a href="{{ route('backend.agenda.index') }}" class="sidebar-link {{ request()->routeIs('backend.agenda*') ? 'active' : '' }}">
            <i class="fa-regular fa-calendar-days"></i>
            <span>Agenda</span>
        </a>

        <a href="{{ route('backend.user.index') }}" class="sidebar-link {{ request()->routeIs('backend.user*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-shield"></i>
            <span>Admin</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
            @csrf
            <button type="submit" class="sidebar-link" style="background:none; border:none; width:100%; text-align:left; cursor:pointer; font:inherit;">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- BACKDROP OVERLAY UNTUK SIDEBAR MOBILE -->
<div class="sidebar-backdrop" aria-hidden="true"></div>
