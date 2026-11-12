@extends('layouts.backend')

@section('title', 'Kelola Organigram - XTIK Programming')

@section('content')
<div class="page-heading" style="display:flex; align-items:center; gap:16px; margin-bottom:26px;">
    <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #ea580c, #f97316); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; box-shadow:0 6px 16px rgba(234, 88, 12, 0.25);">
        <i class="fa-solid fa-sitemap"></i>
    </div>
    <div>
        <h1 style="font-size:1.65rem; font-weight:800; color:#0f172a; margin:0 0 4px 0;">Kelola Struktur Organigram</h1>
        <p style="margin:0; color:#64748b; font-size:0.92rem;">Kelola pembina, pelatih, pengurus inti, dan koordinator divisi ekstrakurikuler XTIK.</p>
    </div>
</div>

<div class="admin-crud-grid">

    <!-- FORM INPUT / EDIT -->
    <div style="background:#ffffff; border-radius:16px; padding:26px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
            <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin:0;">
                {{ $editData ? 'Edit Pengurus' : 'Tambah Pengurus Baru' }}
            </h2>
            @if ($editData)
                <span style="background:#fef3c7; color:#b45309; padding:3px 10px; border-radius:12px; font-size:0.75rem; font-weight:700;">MODE EDIT</span>
            @endif
        </div>

        <form action="{{ $editData ? route('backend.organigram.update', $editData->id) : route('backend.organigram.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if ($editData) @method('PUT') @endif

            <div style="display:flex; flex-direction:column; gap:16px;">
                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Nama Lengkap (dengan Gelar jika ada)</label>
                    <input type="text" name="nama" value="{{ old('nama', $editData->nama ?? '') }}" required
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Jabatan</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $editData->jabatan ?? '') }}" required
                           placeholder="Contoh: Pembina, Pelatih, Ketua, Sekretaris..."
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Foto Profil</label>
                    <input type="file" name="foto" accept="image/*"
                           style="width:100%; padding:8px; border:1px dashed #cbd5e1; border-radius:8px; font-size:0.85rem; background:#f8fafc;">
                    <small style="color:#94a3b8; font-size:0.78rem; display:block; margin-top:4px;">Format: JPG, PNG, WEBP (Maks 3 MB).</small>

                    @if ($editData && $editData->foto)
                        <div style="margin-top:10px; display:flex; align-items:center; gap:10px; background:#f1f5f9; padding:8px; border-radius:8px;">
                            <img src="{{ asset($editData->foto) }}" alt="{{ $editData->nama }}" style="width:48px; height:48px; object-fit:cover; border-radius:8px;">
                            <span style="font-size:0.8rem; color:#475569;">Foto saat ini terpasang</span>
                        </div>
                    @endif
                </div>

                <div style="margin-top:8px; display:flex; align-items:center; gap:10px;">
                    <button type="submit" style="flex:1; padding:11px 18px; background:#ea580c; color:#fff; font-weight:600; font-size:0.9rem; border:none; border-radius:8px; cursor:pointer; box-shadow:0 4px 12px rgba(234, 88, 12, 0.25);">
                        {{ $editData ? 'Simpan Perubahan' : 'Tambah Pengurus' }}
                    </button>
                    @if ($editData)
                        <a href="{{ route('backend.organigram.index') }}" style="padding:11px 16px; background:#f1f5f9; color:#64748b; font-weight:600; font-size:0.9rem; text-decoration:none; border-radius:8px;">
                            Batal
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- TABEL DAFTAR PENGURUS -->
    <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin-bottom:18px;">Daftar Struktur Organisasi ({{ $organigrams->total() }})</h2>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr style="border-bottom:2px solid #f1f5f9; color:#64748b; font-size:0.8rem; text-transform:uppercase;">
                        <th style="padding:10px 12px; width:40px;">No</th>
                        <th style="padding:10px 12px;">Foto</th>
                        <th style="padding:10px 12px;">Nama Lengkap</th>
                        <th style="padding:10px 12px;">Jabatan</th>
                        <th style="padding:10px 12px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($organigrams as $item)
                        <tr style="border-bottom:1px solid #f8fafc; font-size:0.9rem;">
                            <td style="padding:12px; color:#64748b;">
                                {{ $loop->iteration + ($organigrams->currentPage() - 1) * $organigrams->perPage() }}.
                            </td>
                            <td style="padding:12px;">
                                <div style="width:42px; height:42px; border-radius:50%; overflow:hidden; border:2px solid #e2e8f0; background:#f8fafc;">
                                    <img src="{{ asset($item->foto ?: 'image/Logobaru.png') }}" alt="{{ $item->nama }}" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                            </td>
                            <td style="padding:12px; font-weight:600; color:#1e293b;">
                                {{ $item->nama }}
                            </td>
                            <td style="padding:12px;">
                                <span style="display:inline-block; padding:3px 10px; background:#eff6ff; color:#0b5aa2; border-radius:15px; font-size:0.82rem; font-weight:600;">
                                    {{ $item->jabatan }}
                                </span>
                            </td>
                            <td style="padding:12px; text-align:center; white-space:nowrap;">
                                <a href="{{ route('backend.organigram.edit', $item->id) }}" style="display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:#eff6ff; color:#0b5aa2; text-decoration:none; margin-right:4px;" title="Edit">
                                    <i class="fa-solid fa-pen" style="font-size:0.8rem;"></i>
                                </a>
                                <form action="{{ route('backend.organigram.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pengurus ini dari organigram?');">
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
                            <td colspan="5" style="padding:28px; text-align:center; color:#94a3b8;">Belum ada data pengurus organigram.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $organigrams->links() }}
        </div>
    </div>

</div>
@endsection