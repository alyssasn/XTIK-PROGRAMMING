@extends('layouts.backend')

@section('title', 'Kelola Agenda - XTIK Programming')

@section('content')
<div class="page-heading" style="display:flex; align-items:center; gap:16px; margin-bottom:26px;">
    <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #7c3aed, #9333ea); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; box-shadow:0 6px 16px rgba(124, 58, 237, 0.25);">
        <i class="fa-regular fa-calendar-days"></i>
    </div>
    <div>
        <h1 style="font-size:1.65rem; font-weight:800; color:#0f172a; margin:0 0 4px 0;">Kelola Agenda Kegiatan</h1>
        <p style="margin:0; color:#64748b; font-size:0.92rem;">Kelola jadwal pelatihan, workshop, pertemuan rutin, dan agenda ekstrakurikuler.</p>
    </div>
</div>

<div class="admin-crud-grid">

    <!-- FORM INPUT / EDIT AGENDA -->
    <div style="background:#ffffff; border-radius:16px; padding:26px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
            <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin:0;">
                {{ $editData ? 'Edit Agenda' : 'Tambah Agenda Baru' }}
            </h2>
            @if ($editData)
                <span style="background:#fef3c7; color:#b45309; padding:3px 10px; border-radius:12px; font-size:0.75rem; font-weight:700;">MODE EDIT</span>
            @endif
        </div>

        <form action="{{ $editData ? route('backend.agenda.update', $editData->id) : route('backend.agenda.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if ($editData) @method('PUT') @endif

            <div style="display:flex; flex-direction:column; gap:16px;">
                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Judul Agenda Kegiatan</label>
                    <input type="text" name="judul" value="{{ old('judul', $editData->judul ?? '') }}" required
                           placeholder="Contoh: Workshop Laravel & Git Dasar"
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Tanggal Pelaksanaan</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $editData?->tanggal?->format('Y-m-d') ?? date('Y-m-d')) }}" required
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Foto Agenda</label>
                    <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp,.gif,.bmp"
                           style="width:100%; padding:8px; border:1px dashed #cbd5e1; border-radius:8px; font-size:0.85rem; background:#f8fafc;">
                    <small style="color:#94a3b8; font-size:0.78rem; display:block; margin-top:4px;">Format: JPG, PNG, WEBP (Maks 3 MB).</small>

                    @if ($editData && $editData->foto)
                        <div style="margin-top:10px; display:flex; align-items:center; gap:10px; background:#f1f5f9; padding:8px; border-radius:8px;">
                            <img src="{{ asset($editData->foto) }}" alt="{{ $editData->judul }}" style="width:54px; height:40px; object-fit:cover; border-radius:6px;">
                            <span style="font-size:0.8rem; color:#475569;">Gambar saat ini</span>
                        </div>
                    @endif
                </div>


                <div style="margin-top:8px; display:flex; align-items:center; gap:10px;">
                    <button type="submit" style="flex:1; padding:11px 18px; background:#7c3aed; color:#fff; font-weight:600; font-size:0.9rem; border:none; border-radius:8px; cursor:pointer; box-shadow:0 4px 12px rgba(124, 58, 237, 0.25);">
                        {{ $editData ? 'Simpan Perubahan' : 'Tambah Agenda' }}
                    </button>
                    @if ($editData)
                        <a href="{{ route('backend.agenda.index') }}" style="padding:11px 16px; background:#f1f5f9; color:#64748b; font-weight:600; font-size:0.9rem; text-decoration:none; border-radius:8px;">
                            Batal
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- TABEL DAFTAR AGENDA -->
    <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin-bottom:18px;">Daftar Agenda Terjadwal ({{ $agendas->total() }})</h2>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr style="border-bottom:2px solid #f1f5f9; color:#64748b; font-size:0.8rem; text-transform:uppercase;">
                        <th style="padding:10px 12px; width:40px;">No</th>
                        <th style="padding:10px 12px;">Foto</th>
                        <th style="padding:10px 12px;">Judul</th>
                        <th style="padding:10px 12px;">Tanggal</th>
                        <th style="padding:10px 12px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($agendas as $item)
                        <tr style="border-bottom:1px solid #f8fafc; font-size:0.9rem;">
                            <td style="padding:12px; color:#64748b;">
                                {{ $loop->iteration + ($agendas->currentPage() - 1) * $agendas->perPage() }}.
                            </td>
                            <td style="padding:12px;">
                                <div style="width:54px; height:40px; border-radius:6px; overflow:hidden; border:1px solid #e2e8f0; background:#f8fafc;">
                                    <img src="{{ asset($item->foto ?: 'image/beranda.jpg') }}" alt="{{ $item->judul }}" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                            </td>
                            <td style="padding:12px;">
                                <strong style="color:#1e293b;">{{ $item->judul }}</strong>
                            </td>
                            <td style="padding:12px; white-space:nowrap;">
                                <span style="display:inline-flex; align-items:center; gap:6px; font-size:0.84rem; color:#475569;">
                                    <i class="fa-regular fa-calendar" style="color:#7c3aed;"></i>
                                    {{ $item->tanggal ? $item->tanggal->translatedFormat('d M Y') : '-' }}
                                </span>
                            </td>
                            <td style="padding:12px; text-align:center; white-space:nowrap;">
                                <a href="{{ route('backend.agenda.edit', $item->id) }}" style="display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:#eff6ff; color:#0b5aa2; text-decoration:none; margin-right:4px;" title="Edit">
                                    <i class="fa-solid fa-pen" style="font-size:0.8rem;"></i>
                                </a>
                                <form action="{{ route('backend.agenda.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus agenda ini?');">
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
                            <td colspan="5" style="padding:28px; text-align:center; color:#94a3b8;">Belum ada agenda tersimpan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $agendas->links() }}
        </div>
    </div>

</div>
@endsection