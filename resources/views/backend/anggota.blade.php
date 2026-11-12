@extends('layouts.backend')

@section('title', 'Kelola Anggota - XTIK Programming')

@section('content')
<div class="page-heading" style="display:flex; align-items:center; gap:16px; margin-bottom:26px;">
    <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #0284c7, #38bdf8); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; box-shadow:0 6px 16px rgba(2, 132, 199, 0.25);">
        <i class="fa-solid fa-users"></i>
    </div>
    <div>
        <h1 style="font-size:1.65rem; font-weight:800; color:#0f172a; margin:0 0 4px 0;">Kelola Data Anggota</h1>
        <p style="margin:0; color:#64748b; font-size:0.92rem;">Kelola data anggota siswa ekstrakurikuler XTIK SMKN 2 Purwakarta.</p>
    </div>
</div>

<div class="admin-crud-grid">

    <!-- FORM INPUT / EDIT ANGGOTA -->
    <div style="background:#ffffff; border-radius:16px; padding:26px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
            <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin:0;">
                {{ $editData ? 'Edit Data Anggota' : 'Tambah Anggota Baru' }}
            </h2>
            @if ($editData)
                <span style="background:#fef3c7; color:#b45309; padding:3px 10px; border-radius:12px; font-size:0.75rem; font-weight:700;">MODE EDIT</span>
            @endif
        </div>

        <form action="{{ $editData ? route('backend.anggota.update', $editData->id) : route('backend.anggota.store') }}"
              method="POST">
            @csrf
            @if ($editData) @method('PUT') @endif

            <div style="display:flex; flex-direction:column; gap:16px;">
                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Nama Siswa</label>
                    <input type="text" name="nama" value="{{ old('nama', $editData->nama ?? '') }}" required
                           placeholder="Nama lengkap siswa"
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $editData->kelas ?? '') }}" required
                           placeholder="Contoh: X, XI, XII"
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Jurusan</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $editData->jurusan ?? '') }}" required
                           placeholder="Contoh: Rekayasa Perangkat Lunak"
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                            style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem; background:#fff;">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" @selected(old('jenis_kelamin', $editData->jenis_kelamin ?? '') == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('jenis_kelamin', $editData->jenis_kelamin ?? '') == 'Perempuan')>Perempuan</option>
                    </select>
                </div>

                <div style="margin-top:8px; display:flex; align-items:center; gap:10px;">
                    <button type="submit" style="flex:1; padding:11px 18px; background:#0284c7; color:#fff; font-weight:600; font-size:0.9rem; border:none; border-radius:8px; cursor:pointer; box-shadow:0 4px 12px rgba(2, 132, 199, 0.25);">
                        {{ $editData ? 'Simpan Perubahan' : 'Tambah Anggota' }}
                    </button>
                    @if ($editData)
                        <a href="{{ route('backend.anggota.index') }}" style="padding:11px 16px; background:#f1f5f9; color:#64748b; font-weight:600; font-size:0.9rem; text-decoration:none; border-radius:8px;">
                            Batal
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- TABEL DAFTAR ANGGOTA DENGAN SEARCH BAR -->
    <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px; margin-bottom:20px;">
            <div>
                <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin:0 0 2px 0;">Daftar Anggota ({{ $anggotas->total() }})</h2>
                <span style="font-size:0.82rem; color:#64748b;">Menampilkan data siswa aktif ekstrakurikuler</span>
            </div>

            <!-- SEARCH BAR -->
            <form method="GET" action="{{ route('backend.anggota.index') }}" style="display:flex; align-items:center; gap:8px;">
                <div style="position:relative;">
                    <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:0.85rem;"></i>
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama, kelas, jurusan..."
                           style="padding:8px 12px 8px 34px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.88rem; width:220px;">
                </div>
                <button type="submit" style="padding:8px 14px; background:#0b5aa2; color:#fff; border:none; border-radius:8px; font-size:0.85rem; font-weight:600; cursor:pointer;">
                    Cari
                </button>
                @if (request()->filled('cari'))
                    <a href="{{ route('backend.anggota.index') }}" style="padding:8px 12px; background:#f1f5f9; color:#64748b; border-radius:8px; font-size:0.85rem; text-decoration:none;">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr style="border-bottom:2px solid #f1f5f9; color:#64748b; font-size:0.8rem; text-transform:uppercase;">
                        <th style="padding:10px 12px; width:40px;">No</th>
                        <th style="padding:10px 12px;">Nama Siswa</th>
                        <th style="padding:10px 12px;">Kelas</th>
                        <th style="padding:10px 12px;">Jurusan</th>
                        <th style="padding:10px 12px;">Jenis Kelamin</th>
                        <th style="padding:10px 12px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotas as $item)
                        <tr style="border-bottom:1px solid #f8fafc; font-size:0.9rem;">
                            <td style="padding:12px; color:#64748b;">
                                {{ $loop->iteration + ($anggotas->currentPage() - 1) * $anggotas->perPage() }}.
                            </td>
                            <td style="padding:12px; font-weight:600; color:#1e293b;">
                                {{ $item->nama }}
                            </td>
                            <td style="padding:12px;">
                                <span style="display:inline-block; padding:3px 8px; background:#f1f5f9; color:#334155; border-radius:6px; font-size:0.82rem; font-weight:600;">
                                    {{ $item->kelas }}
                                </span>
                            </td>
                            <td style="padding:12px; color:#475569; font-size:0.85rem;">
                                {{ $item->jurusan }}
                            </td>
                            <td style="padding:12px; font-size:0.85rem;">
                                @if ($item->jenis_kelamin === 'Laki-laki')
                                    <span style="color:#0284c7;"><i class="fa-solid fa-mars"></i> Laki-laki</span>
                                @else
                                    <span style="color:#ec4899;"><i class="fa-solid fa-venus"></i> Perempuan</span>
                                @endif
                            </td>
                            <td style="padding:12px; text-align:center; white-space:nowrap;">
                                <a href="{{ route('backend.anggota.edit', $item->id) }}" style="display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:#eff6ff; color:#0b5aa2; text-decoration:none; margin-right:4px;" title="Edit">
                                    <i class="fa-solid fa-pen" style="font-size:0.8rem;"></i>
                                </a>
                                <form action="{{ route('backend.anggota.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus anggota ini?');">
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
                            <td colspan="6" style="padding:28px; text-align:center; color:#94a3b8;">Tidak ada data anggota ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $anggotas->links('partials.pagination_custom') }}
        </div>
    </div>

</div>
@endsection