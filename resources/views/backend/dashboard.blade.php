@extends('layouts.backend')

@section('title', 'Dashboard Admin - XTIK Programming')

@section('content')
<!-- WELCOME BANNER & DB STATUS -->
<div style="background:linear-gradient(135deg, #0b5aa2 0%, #1e40af 100%); border-radius:18px; padding:28px 32px; color:#ffffff; margin-bottom:28px; box-shadow:0 10px 25px rgba(11, 90, 162, 0.2); position:relative; overflow:hidden;">
    <div style="position:relative; z-index:2;">
        <h1 style="font-size:1.85rem; font-weight:800; margin:0 0 8px 0; letter-spacing:0.3px;">
            Selamat Datang, {{ auth()->user()?->name ?? 'Admin Programming' }}!
        </h1>
        <p style="margin:0; font-size:0.95rem; color:rgba(255,255,255,0.9); max-width:650px; line-height:1.6;">
            Panel administrasi sistem informasi ekstrakurikuler XTIK SMKN 2 Purwakarta. Pantau statistik dan kelola seluruh konten website dengan mudah.
        </p>
    </div>
</div>

<!-- ================= STATS CARDS ================= -->
<div class="admin-stats-cards-grid">

    <!-- CARD 1: ANGGOTA -->
    <div style="background:#ffffff; border-radius:16px; padding:22px 24px; box-shadow:0 4px 18px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0; display:flex; align-items:center; gap:18px;">
        <div style="width:56px; height:56px; border-radius:14px; background:#eff6ff; color:#0b5aa2; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0;">
            <i class="fa-solid fa-user-group"></i>
        </div>
        <div>
            <span style="display:block; font-size:0.82rem; font-weight:600; color:#64748b; text-transform:uppercase;">Total Anggota</span>
            <strong style="font-size:1.9rem; font-weight:800; color:#0f172a; line-height:1.1;">{{ $totalAnggota }}</strong>
            <small style="display:block; font-size:0.75rem; color:#10b981; font-weight:600; margin-top:2px;">Siswa Aktif</small>
        </div>
    </div>

    <!-- CARD 2: BERITA -->
    <div style="background:#ffffff; border-radius:16px; padding:22px 24px; box-shadow:0 4px 18px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0; display:flex; align-items:center; gap:18px;">
        <div style="width:56px; height:56px; border-radius:14px; background:#f0fdf4; color:#16a34a; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0;">
            <i class="fa-regular fa-newspaper"></i>
        </div>
        <div>
            <span style="display:block; font-size:0.82rem; font-weight:600; color:#64748b; text-transform:uppercase;">Publikasi Berita</span>
            <strong style="font-size:1.9rem; font-weight:800; color:#0f172a; line-height:1.1;">{{ $totalBerita }}</strong>
            <small style="display:block; font-size:0.75rem; color:#64748b; font-weight:500; margin-top:2px;">Artikel Terbit</small>
        </div>
    </div>

    <!-- CARD 3: AGENDA -->
    <div style="background:#ffffff; border-radius:16px; padding:22px 24px; box-shadow:0 4px 18px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0; display:flex; align-items:center; gap:18px;">
        <div style="width:56px; height:56px; border-radius:14px; background:#faf5ff; color:#9333ea; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0;">
            <i class="fa-regular fa-calendar-check"></i>
        </div>
        <div>
            <span style="display:block; font-size:0.82rem; font-weight:600; color:#64748b; text-transform:uppercase;">Agenda Kegiatan</span>
            <strong style="font-size:1.9rem; font-weight:800; color:#0f172a; line-height:1.1;">{{ $totalAgenda }}</strong>
            <small style="display:block; font-size:0.75rem; color:#64748b; font-weight:500; margin-top:2px;">Jadwal Terdaftar</small>
        </div>
    </div>

    <!-- CARD 4: ORGANIGRAM -->
    <div style="background:#ffffff; border-radius:16px; padding:22px 24px; box-shadow:0 4px 18px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0; display:flex; align-items:center; gap:18px;">
        <div style="width:56px; height:56px; border-radius:14px; background:#fff7ed; color:#ea580c; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0;">
            <i class="fa-solid fa-sitemap"></i>
        </div>
        <div>
            <span style="display:block; font-size:0.82rem; font-weight:600; color:#64748b; text-transform:uppercase;">Pengurus Organisasi</span>
            <strong style="font-size:1.9rem; font-weight:800; color:#0f172a; line-height:1.1;">{{ $totalOrganigram }}</strong>
            <small style="display:block; font-size:0.75rem; color:#64748b; font-weight:500; margin-top:2px;">Struktur Terdaftar</small>
        </div>
    </div>

</div>

<!-- QUICK SHORTCUT BUTTONS -->
<div style="background:#ffffff; border-radius:16px; padding:20px 24px; box-shadow:0 4px 18px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0; margin-bottom:28px;">
    <h3 style="font-size:0.95rem; font-weight:700; color:#0f172a; margin:0 0 14px 0; text-transform:uppercase; letter-spacing:0.5px;">Aksi Cepat Manajemen Konten</h3>
    <div style="display:flex; flex-wrap:wrap; gap:12px;">
        <a href="{{ route('backend.berita.index') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#0b5aa2; color:#fff; border-radius:10px; text-decoration:none; font-size:0.88rem; font-weight:600; transition:all 0.2s;">
            <i class="fa-solid fa-plus"></i> Tambah Berita
        </a>
        <a href="{{ route('backend.agenda.index') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#16a34a; color:#fff; border-radius:10px; text-decoration:none; font-size:0.88rem; font-weight:600; transition:all 0.2s;">
            <i class="fa-solid fa-plus"></i> Tambah Agenda
        </a>
        <a href="{{ route('backend.anggota.index') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#0284c7; color:#fff; border-radius:10px; text-decoration:none; font-size:0.88rem; font-weight:600; transition:all 0.2s;">
            <i class="fa-solid fa-plus"></i> Tambah Anggota
        </a>
        <a href="{{ route('backend.organigram.index') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#ea580c; color:#fff; border-radius:10px; text-decoration:none; font-size:0.88rem; font-weight:600; transition:all 0.2s;">
            <i class="fa-solid fa-plus"></i> Tambah Pengurus
        </a>
        <a href="{{ route('backend.profil') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#f1f5f9; color:#334155; border:1px solid #cbd5e1; border-radius:10px; text-decoration:none; font-size:0.88rem; font-weight:600; transition:all 0.2s;">
            <i class="fa-solid fa-pen-to-square"></i> Kelola Profil Ekskul
        </a>

    </div>
</div>

<!-- ================= 2 COLUMNS: BERITA & AGENDA ================= -->
<div class="admin-dashboard-split">

    <!-- LEFT: BERITA TERBARU -->
    <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 18px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
            <div>
                <h3 style="font-size:1.1rem; font-weight:700; color:#0f172a; margin:0 0 2px 0;">Berita Terbaru</h3>
                <p style="margin:0; font-size:0.82rem; color:#64748b;">Artikel dan pengumuman yang baru diterbitkan</p>
            </div>
            <a href="{{ route('backend.berita.index') }}" style="font-size:0.84rem; color:#0b5aa2; text-decoration:none; font-weight:600;">
                Semua Berita &rarr;
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr style="border-bottom:2px solid #f1f5f9; color:#64748b; font-size:0.8rem; text-transform:uppercase;">
                        <th style="padding:10px 12px;">No</th>
                        <th style="padding:10px 12px;">Judul</th>
                        <th style="padding:10px 12px;">Tanggal</th>
                        <th style="padding:10px 12px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($beritaTerbaru as $item)
                        <tr style="border-bottom:1px solid #f8fafc; font-size:0.9rem;">
                            <td style="padding:12px; color:#64748b;">{{ $loop->iteration }}.</td>
                            <td style="padding:12px; font-weight:600; color:#1e293b;">
                                {{ $item->judul }}
                            </td>
                            <td style="padding:12px; color:#64748b; font-size:0.84rem; white-space:nowrap;">
                                {{ $item->tanggal ? $item->tanggal->translatedFormat('d M Y') : '-' }}
                            </td>
                            <td style="padding:12px; text-align:center; white-space:nowrap;">
                                <a href="{{ route('backend.berita.edit', $item->id) }}" style="display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:#eff6ff; color:#0b5aa2; text-decoration:none; margin-right:4px;" title="Edit">
                                    <i class="fa-solid fa-pen" style="font-size:0.8rem;"></i>
                                </a>
                                <form action="{{ route('backend.berita.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="width:32px; height:32px; border-radius:8px; background:#fef2f2; color:#ef4444; border:none; cursor:pointer;" title="Hapus">
                                        <i class="fa-solid fa-trash" style="font-size:0.8rem;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:24px; text-align:center; color:#94a3b8;">Belum ada berita terpublikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- RIGHT: AGENDA TERDEKAT & INFO SISTEM -->
    <div style="display:flex; flex-direction:column; gap:24px;">

        <!-- AGENDA TERDEKAT -->
        <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 18px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h3 style="font-size:1.1rem; font-weight:700; color:#0f172a; margin:0;">Agenda Terdekat</h3>
                <a href="{{ route('backend.agenda.index') }}" style="font-size:0.84rem; color:#0b5aa2; text-decoration:none; font-weight:600;">
                    Kelola &rarr;
                </a>
            </div>

            <div style="display:flex; flex-direction:column; gap:12px;">
                @forelse ($agendaTerdekat as $item)
                    <div style="display:flex; align-items:center; gap:14px; padding:10px 12px; border-radius:10px; background:#f8fafc; border:1px solid #f1f5f9;">
                        <div style="width:44px; height:44px; border-radius:10px; background:#ede9fe; color:#7c3aed; display:flex; flex-direction:column; align-items:center; justify-content:center; flex-shrink:0;">
                            <span style="font-size:0.95rem; font-weight:800; line-height:1;">{{ $item->tanggal ? $item->tanggal->format('d') : '01' }}</span>
                            <span style="font-size:0.65rem; font-weight:700; text-transform:uppercase;">{{ $item->tanggal ? $item->tanggal->translatedFormat('M') : 'JAN' }}</span>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <strong style="display:block; font-size:0.88rem; color:#1e293b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                {{ $item->judul }}
                            </strong>
                            <span style="font-size:0.75rem; color:#64748b;">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi, 50) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p style="color:#94a3b8; font-size:0.88rem; text-align:center; padding:16px 0;">Belum ada agenda terdaftar.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection