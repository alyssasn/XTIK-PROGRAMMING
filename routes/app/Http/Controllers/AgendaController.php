<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaController extends Controller
{
    public function index()
    {
        return $this->renderIndex(null);
    }

    public function create()
    {
        return $this->renderIndex(null);
    }

    public function edit(Agenda $agenda)
    {
        return $this->renderIndex($agenda);
    }

    private function renderIndex(?Agenda $editData)
    {
        $agendas = Agenda::orderByDesc('tanggal')->paginate(10);

        return view('backend.agenda', [
            'agendas' => $agendas,
            'editData' => $editData,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $fotoPath = 'image/beranda.jpg';
        $file = $request->file('foto') ?? $request->file('gambar');

        if ($file) {
            $filename = 'agenda_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/agenda'), $filename);
            $fotoPath = 'image/agenda/' . $filename;
        }

        Agenda::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal' => $validated['tanggal'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('backend.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $file = $request->file('foto') ?? $request->file('gambar');

        if ($file) {
            if ($agenda->foto && $agenda->foto !== 'image/beranda.jpg' && File::exists(public_path($agenda->foto))) {
                File::delete(public_path($agenda->foto));
            }

            $filename = 'agenda_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/agenda'), $filename);
            $agenda->foto = 'image/agenda/' . $filename;
        }

        $agenda->judul = $validated['judul'];
        $agenda->deskripsi = $validated['deskripsi'];
        $agenda->tanggal = $validated['tanggal'];
        $agenda->save();

        return redirect()->route('backend.agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->foto && $agenda->foto !== 'image/beranda.jpg' && File::exists(public_path($agenda->foto))) {
            File::delete(public_path($agenda->foto));
        }

        $agenda->delete();

        return redirect()->route('backend.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
