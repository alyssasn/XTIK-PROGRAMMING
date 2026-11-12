<!-- ================= MODERN FOOTER ================= -->
<footer class="footer-figma">
    <div class="footer-container">

        <div class="footer-brand-side">
            <div class="footer-logo">
                <img src="{{ asset('image/Logobaru.png') }}" alt="Logo XTIK SMKN 2 Purwakarta">
                <div>
                    <h4>XTIK - PROGRAMMING</h4>
                    <p>SMKN 2 PURWAKARTA</p>
                </div>
            </div>
            <p class="footer-motto">
                Dirancang dan dikembangkan oleh <strong style="color:#cbd5e1;">Alyssa Sri Nurdewi</strong>, siswa SMKN 2 Purwakarta, sebagai karya nyata di bidang Rekayasa Perangkat Lunak melalui ekstrakurikuler XTIK Programming.
            </p>
        </div>

        <div class="footer-nav-side">
            <h5>Navigasi Halaman</h5>
            <div class="footer-links-grid">
                <a href="{{ url('/beranda') }}">Beranda</a>
                <a href="{{ url('/profil') }}">Profil</a>
                <a href="{{ url('/organigram') }}">Organigram</a>
                <a href="{{ url('/berita') }}">Berita</a>
                <a href="{{ url('/anggota') }}">Anggota</a>
                <a href="{{ url('/agenda') }}">Agenda</a>
            </div>
        </div>

        <div class="footer-social-side">
            <h5>Media Sosial</h5>
            <p>Ikuti akun media sosial resmi kami untuk kabar kegiatan terbaru:</p>
            <a href="https://www.instagram.com/xtiksmekda" target="_blank" rel="noopener noreferrer" class="instagram-link">
                <i class="fa-brands fa-instagram"></i>
                <span>@xtiksmekda</span>
            </a>
        </div>

    </div>

    <div class="footer-bottom-bar">
        <div class="footer-bottom-container">
            <p>© {{ date('Y') }} XTIK Programming SMKN 2 Purwakarta.</p>

        </div>
    </div>
</footer>

<!-- BACK TO TOP BUTTON -->
<a href="#" class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <i class="fa-solid fa-arrow-up"></i>
</a>

<!-- Frontend Script -->
<script src="{{ asset('js/frontend.js') }}"></script>
