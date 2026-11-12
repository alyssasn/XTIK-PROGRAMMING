<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        return $this->renderIndex(null, $request);
    }

    public function create(Request $request)
    {
        return $this->renderIndex(null, $request);
    }

    public function edit(Anggota $anggota, Request $request)
    {
        return $this->renderIndex($anggota, $request);
    }

    private function renderIndex(?Anggota $editData, ?Request $request = null)
    {
        $query = Anggota::query();

        if ($request && ($request->filled('cari') || $request->filled('q'))) {
            $keyword = $request->input('cari') ?: $request->input('q');
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('kelas', 'like', "%{$keyword}%")
                  ->orWhere('jurusan', 'like', "%{$keyword}%");
            });
        }

        $anggotas = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('backend.anggota', [
            'anggotas' => $anggotas,
            'editData' => $editData,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'kelas' => ['required', 'string', 'max:20'],
            'jurusan' => ['required', 'string', 'max:50'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
        ]);

        $anggota = new Anggota();
        $anggota->nama = $validated['nama'];
        $anggota->kelas = $validated['kelas'];
        $anggota->jurusan = $validated['jurusan'];
        $anggota->jenis_kelamin = $validated['jenis_kelamin'];
        $anggota->save();

        return redirect()->route('backend.anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'kelas' => ['required', 'string', 'max:20'],
            'jurusan' => ['required', 'string', 'max:50'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
        ]);

        $anggota->nama = $validated['nama'];
        $anggota->kelas = $validated['kelas'];
        $anggota->jurusan = $validated['jurusan'];
        $anggota->jenis_kelamin = $validated['jenis_kelamin'];
        $anggota->save();

        return redirect()->route('backend.anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('backend.anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
