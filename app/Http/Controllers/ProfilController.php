<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    public function edit()
    {
        $profil = $this->getProfil();

        return view('backend.profil', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = $this->getProfil();

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],
            'deskripsi_bawah' => ['nullable', 'string'],
            'gambar_utama' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        if ($request->hasFile('gambar_utama')) {
            if ($profil->gambar_utama && $profil->gambar_utama !== 'image/laptop.png' && File::exists(public_path($profil->gambar_utama))) {
                File::delete(public_path($profil->gambar_utama));
            }

            $file = $request->file('gambar_utama');
            $filename = 'profil_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/profil'), $filename);
            $profil->gambar_utama = 'image/profil/' . $filename;
        }

        $profil->judul = $validated['judul'];
        $profil->deskripsi = $validated['deskripsi'];
        $profil->isi = $validated['deskripsi'];
        $profil->visi = $validated['visi'] ?? '';
        $profil->misi = $validated['misi'] ?? '';
        $profil->deskripsi_bawah = $validated['deskripsi_bawah'] ?? '';
        $profil->save();

        return redirect()->route('backend.profil')->with('success', 'Profil ekstrakurikuler berhasil diperbarui.');
    }

    private function getProfil(): Profil
    {
        return Profil::firstOrCreate([], [
            'judul' => 'XTIK PROGRAMMING',
            'isi' => 'XTIK bidang Programming ini adalah ekstrakurikuler di bidang teknologi informasi, khususnya pemrograman.',
            'deskripsi' => 'XTIK bidang Programming ini adalah ekstrakurikuler di bidang teknologi informasi, khususnya pemrograman.',
            'visi' => 'Menjadi ekstrakurikuler yang unggul dalam mengembangkan kemampuan siswa di bidang pemrograman dan teknologi informasi.',
            'misi' => 'Ekstrakurikuler XTIK adalah membekali siswa dengan pengetahuan dan keterampilan di bidang pemrograman melalui kegiatan yang edukatif dan kreatif.',
            'gambar_utama' => 'image/laptop.png',
            'deskripsi_bawah' => 'Bergabunglah bersama kami di XTIK SMKN 2 Purwakarta!'
        ]);
    }
}
