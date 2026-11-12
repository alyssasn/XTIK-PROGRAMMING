@extends('layouts.backend')

@section('title', 'Kelola Profil Ekstrakurikuler - XTIK Programming')

@section('content')
<div class="page-heading" style="display:flex; align-items:center; gap:16px; margin-bottom:26px;">
    <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #0b5aa2, #3b82f6); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; box-shadow:0 6px 16px rgba(11, 90, 162, 0.25);">
        <i class="fa-solid fa-school"></i>
    </div>
    <div>
        <h1 style="font-size:1.65rem; font-weight:800; color:#0f172a; margin:0 0 4px 0;">Kelola Profil Ekstrakurikuler</h1>
        <p style="margin:0; color:#64748b; font-size:0.92rem;">Kelola identitas, visi, misi, deskripsi, dan media utama ekstrakurikuler XTIK SMKN 2 Purwakarta.</p>
    </div>
</div>

<div style="background:#ffffff; border-radius:16px; padding:32px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0; max-width:980px;">
    <form action="{{ route('backend.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display:flex; flex-direction:column; gap:22px;">

            <!-- JUDUL PROFIL -->
            <div>
                <label style="display:block; font-weight:600; font-size:0.9rem; color:#334155; margin-bottom:6px;">
                    Judul Utama Profil Ekstrakurikuler
                </label>
                <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" required
                       style="width:100%; padding:11px 14px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.95rem;">
            </div>

            <!-- DESKRIPSI UTAMA -->
            <div>
                <label style="display:block; font-weight:600; font-size:0.9rem; color:#334155; margin-bottom:6px;">
                    Deskripsi Profil (Tentang Kami)
                </label>
                <textarea name="deskripsi" rows="5" required
                          style="width:100%; padding:11px 14px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.95rem; resize:vertical;">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                <small style="color:#64748b; font-size:0.8rem; margin-top:4px; display:block;">Deskripsi ini ditampilkan pada section Tentang Kami di halaman Beranda dan Profil.</small>
            </div>

            <!-- VISI & MISI -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px;">
                <div>
                    <label style="display:block; font-weight:600; font-size:0.9rem; color:#334155; margin-bottom:6px;">
                        Visi Ekstrakurikuler
                    </label>
                    <textarea name="visi" rows="5"
                              style="width:100%; padding:11px 14px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.95rem; resize:vertical;">{{ old('visi', $profil->visi) }}</textarea>
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.9rem; color:#334155; margin-bottom:6px;">
                        Misi Ekstrakurikuler
                    </label>
                    <textarea name="misi" rows="5"
                              style="width:100%; padding:11px 14px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.95rem; resize:vertical;">{{ old('misi', $profil->misi) }}</textarea>
                </div>
            </div>

            <!-- GAMBAR UTAMA / ILUSTRASI -->
            <div>
                <label style="display:block; font-weight:600; font-size:0.9rem; color:#334155; margin-bottom:6px;">
                    Gambar Utama / Ilustrasi
                </label>
                <div style="display:flex; align-items:center; gap:20px; background:#f8fafc; padding:16px; border-radius:12px; border:1px dashed #cbd5e1; flex-wrap:wrap;">
                    <div style="width:120px; height:80px; border-radius:8px; overflow:hidden; border:1px solid #e2e8f0; background:#fff; flex-shrink:0;">
                        <img src="{{ asset($profil->gambar_utama ?: 'image/laptop.png') }}" alt="Gambar Utama" style="width:100%; height:100%; object-fit:contain;">
                    </div>
                    <div style="flex:1; min-width:200px;">
                        <input type="file" name="gambar_utama" accept="image/*" style="font-size:0.9rem;">
                        <small style="color:#94a3b8; display:block; margin-top:4px;">Format: JPG, PNG, WEBP (Maksimal 3 MB).</small>
                    </div>
                </div>
            </div>

            <!-- DESKRIPSI BAWAH -->
            <div>
                <label style="display:block; font-weight:600; font-size:0.9rem; color:#334155; margin-bottom:6px;">
                    Deskripsi Ajakan (CTA Bottom)
                </label>
                <textarea name="deskripsi_bawah" rows="3"
                          style="width:100%; padding:11px 14px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.95rem; resize:vertical;">{{ old('deskripsi_bawah', $profil->deskripsi_bawah) }}</textarea>
            </div>

            <!-- BUTTON -->
            <div style="padding-top:12px; border-top:1px solid #f1f5f9; display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                <button type="submit" style="display:inline-flex; align-items:center; gap:8px; padding:12px 28px; background:#0b5aa2; color:#ffffff; font-weight:600; font-size:0.95rem; border:none; border-radius:8px; cursor:pointer; box-shadow:0 4px 12px rgba(11, 90, 162, 0.25);">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan Profil</span>
                </button>
                <a href="{{ route('backend.dashboard') }}" style="padding:12px 20px; color:#64748b; font-weight:600; font-size:0.95rem; text-decoration:none;">
                    Batal
                </a>
            </div>

        </div>
    </form>
</div>
@endsection