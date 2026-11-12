<?php

namespace App\Http\Controllers;

use App\Models\Organigram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrganigramController extends Controller
{
    public function index()
    {
        return $this->renderIndex(null);
    }

    public function create()
    {
        return $this->renderIndex(null);
    }

    public function edit(Organigram $organigram)
    {
        return $this->renderIndex($organigram);
    }

    private function renderIndex(?Organigram $editData)
    {
        $organigrams = Organigram::orderBy('id')->paginate(10);

        return view('backend.organigram', [
            'organigrams' => $organigrams,
            'editData' => $editData,
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->filled('nama') && $request->filled('nama_lengkap')) {
            $request->merge(['nama' => $request->input('nama_lengkap')]);
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:50'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $fotoPath = 'image/Logobaru.png';
        $file = $request->file('foto') ?? $request->file('gambar');

        if ($file) {
            $filename = 'organigram_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/organigram'), $filename);
            $fotoPath = 'image/organigram/' . $filename;
        }

        Organigram::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('backend.organigram.index')->with('success', 'Pengurus organigram berhasil ditambahkan.');
    }

    public function update(Request $request, Organigram $organigram)
    {
        if (!$request->filled('nama') && $request->filled('nama_lengkap')) {
            $request->merge(['nama' => $request->input('nama_lengkap')]);
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:50'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $file = $request->file('foto') ?? $request->file('gambar');
        if ($file) {
            if ($organigram->foto && $organigram->foto !== 'image/Logobaru.png' && File::exists(public_path($organigram->foto))) {
                File::delete(public_path($organigram->foto));
            }

            $filename = 'organigram_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/organigram'), $filename);
            $organigram->foto = 'image/organigram/' . $filename;
        }

        $organigram->nama = $validated['nama'];
        $organigram->jabatan = $validated['jabatan'];
        $organigram->save();

        return redirect()->route('backend.organigram.index')->with('success', 'Data pengurus organigram berhasil diperbarui.');
    }

    public function destroy(Organigram $organigram)
    {
        if ($organigram->foto && $organigram->foto !== 'image/Logobaru.png' && File::exists(public_path($organigram->foto))) {
            File::delete(public_path($organigram->foto));
        }

        $organigram->delete();

        return redirect()->route('backend.organigram.index')->with('success', 'Pengurus organigram berhasil dihapus.');
    }
}
