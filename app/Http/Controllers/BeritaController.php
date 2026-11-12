<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index()
    {
        return $this->renderIndex(null);
    }

    public function create()
    {
        return $this->renderIndex(null);
    }

    public function edit(Berita $berita)
    {
        return $this->renderIndex($berita);
    }

    private function renderIndex(?Berita $editData)
    {
        $beritas = Berita::orderByDesc('tanggal')->paginate(10);

        return view('backend.berita', [
            'beritas' => $beritas,
            'editData' => $editData,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal' => ['required', 'date'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $isi = $validated['isi'] ?? $validated['deskripsi'] ?? '';

        $fotoPath = 'image/beranda.jpg';
        $file = $request->file('foto') ?? $request->file('gambar');

        if ($file) {
            $filename = 'berita_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/berita'), $filename);
            $fotoPath = 'image/berita/' . $filename;
        }

        Berita::create([
            'judul' => $validated['judul'],
            'isi' => $isi,
            'tanggal' => $validated['tanggal'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('backend.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal' => ['required', 'date'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $file = $request->file('foto') ?? $request->file('gambar');
        if ($file) {
            if ($berita->foto && $berita->foto !== 'image/beranda.jpg' && File::exists(public_path($berita->foto))) {
                File::delete(public_path($berita->foto));
            }

            $filename = 'berita_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/berita'), $filename);
            $berita->foto = 'image/berita/' . $filename;
        }

        $berita->judul = $validated['judul'];
        if (isset($validated['isi']) || isset($validated['deskripsi'])) {
            $berita->isi = $validated['isi'] ?? $validated['deskripsi'] ?? '';
        }
        $berita->tanggal = $validated['tanggal'];
        $berita->save();

        return redirect()->route('backend.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->foto && $berita->foto !== 'image/beranda.jpg' && File::exists(public_path($berita->foto))) {
            File::delete(public_path($berita->foto));
        }

        $berita->delete();

        return redirect()->route('backend.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
