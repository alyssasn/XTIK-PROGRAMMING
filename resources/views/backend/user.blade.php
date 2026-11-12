@extends('layouts.backend')

@section('title', 'Kelola User Administrator - XTIK Programming')

@section('content')
<div class="page-heading" style="display:flex; align-items:center; gap:16px; margin-bottom:26px;">
    <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #475569, #1e293b); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; box-shadow:0 6px 16px rgba(30, 41, 59, 0.25);">
        <i class="fa-solid fa-users-gear"></i>
    </div>
    <div>
        <h1 style="font-size:1.65rem; font-weight:800; color:#0f172a; margin:0 0 4px 0;">Kelola Pengguna Administrator</h1>
        <p style="margin:0; color:#64748b; font-size:0.92rem;">Kelola hak akses dan akun administrator sistem informasi XTIK SMKN 2 Purwakarta.</p>
    </div>
</div>

<div class="admin-crud-grid">

    <!-- FORM TAMBAH / EDIT USER -->
    <div style="background:#ffffff; border-radius:16px; padding:26px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
            <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin:0;">
                {{ $editData ? 'Edit User Admin' : 'Tambah User Admin' }}
            </h2>
            @if ($editData)
                <span style="background:#fef3c7; color:#b45309; padding:3px 10px; border-radius:12px; font-size:0.75rem; font-weight:700;">MODE EDIT</span>
            @endif
        </div>

        <form action="{{ $editData ? route('backend.user.update', $editData->id) : route('backend.user.store') }}" method="POST">
            @csrf
            @if ($editData) @method('PUT') @endif

            <div style="display:flex; flex-direction:column; gap:16px;">
                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">Username</label>
                    <input type="text" name="username" value="{{ old('username', $editData->username ?? '') }}" required
                           placeholder="Username login"
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; font-size:0.86rem; color:#334155; margin-bottom:6px;">
                        Password {{ $editData ? '(kosongkan bila tidak diubah)' : '' }}
                    </label>
                    <input type="password" name="password" {{ $editData ? '' : 'required' }}
                           placeholder="{{ $editData ? 'Biarkan kosong untuk password lama' : 'Minimal 6 karakter' }}"
                           style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:8px; font-size:0.92rem;">
                </div>

                <div style="margin-top:8px; display:flex; align-items:center; gap:10px;">
                    <button type="submit" style="flex:1; padding:11px 18px; background:#1e293b; color:#fff; font-weight:600; font-size:0.9rem; border:none; border-radius:8px; cursor:pointer; box-shadow:0 4px 12px rgba(30, 41, 59, 0.25);">
                        {{ $editData ? 'Simpan Perubahan' : 'Tambah User' }}
                    </button>
                    @if ($editData)
                        <a href="{{ route('backend.user.index') }}" style="padding:11px 16px; background:#f1f5f9; color:#64748b; font-weight:600; font-size:0.9rem; text-decoration:none; border-radius:8px;">
                            Batal
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- TABEL DAFTAR USER -->
    <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 20px rgba(15, 23, 42, 0.05); border:1px solid #e2e8f0;">
        <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin-bottom:18px;">Daftar Administrator Sistem ({{ $users->total() }})</h2>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr style="border-bottom:2px solid #f1f5f9; color:#64748b; font-size:0.8rem; text-transform:uppercase;">
                        <th style="padding:10px 12px; width:40px;">No</th>
                        <th style="padding:10px 12px;">Username</th>
                        <th style="padding:10px 12px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr style="border-bottom:1px solid #f8fafc; font-size:0.9rem;">
                            <td style="padding:12px; color:#64748b;">
                                {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}.
                            </td>
                            <td style="padding:12px; font-weight:600; color:#1e293b;">
                                <code>{{ $item->username }}</code>
                                @if ($item->id === auth()->id())
                                    <span style="display:inline-block; font-size:0.7rem; background:#eff6ff; color:#0b5aa2; padding:2px 8px; border-radius:10px; margin-left:6px; font-weight:700;">AKUN ANDA</span>
                                @endif
                            </td>
                            <td style="padding:12px; text-align:center; white-space:nowrap;">
                                <a href="{{ route('backend.user.edit', $item->id) }}" style="display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:#eff6ff; color:#0b5aa2; text-decoration:none; margin-right:4px;" title="Edit">
                                    <i class="fa-solid fa-pen" style="font-size:0.8rem;"></i>
                                </a>

                                @if ($item->id !== auth()->id())
                                    <form action="{{ route('backend.user.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="width:32px; height:32px; border-radius:8px; background:#fef2f2; color:#ef4444; border:none; cursor:pointer;" title="Hapus">
                                            <i class="fa-solid fa-trash" style="font-size:0.8rem;"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="padding:28px; text-align:center; color:#94a3b8;">Belum ada data administrator.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection