<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaController extends Controller
{
    /** Ekstensi gambar yang diizinkan */
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp'];

    /** Ukuran maksimal upload: 3 MB dalam bytes */
    private const MAX_SIZE_BYTES = 3 * 1024 * 1024;

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
            'agendas'  => $agendas,
            'editData' => $editData,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => ['required', 'string', 'max:100'],
            'tanggal'   => ['required', 'date'],
        ]);

        $fotoPath = 'image/beranda.jpg';
        $file     = $this->getUploadedFoto($request);

        if ($file !== null) {
            $this->validateFile($file);
            $ext      = strtolower($file->getClientOriginalExtension()) ?: 'jpg';
            $filename = 'agenda_' . time() . '_' . uniqid() . '.' . $ext;
            $file->move(public_path('image/agenda'), $filename);
            $fotoPath = 'image/agenda/' . $filename;
        }

        Agenda::create([
            'judul'   => $validated['judul'],
            'tanggal' => $validated['tanggal'],
            'foto'      => $fotoPath,
        ]);

        return redirect()->route('backend.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'judul'   => ['required', 'string', 'max:100'],
            'tanggal' => ['required', 'date'],
        ]);

        $file = $this->getUploadedFoto($request);

        if ($file !== null) {
            $this->validateFile($file);

            if ($agenda->foto && $agenda->foto !== 'image/beranda.jpg' && File::exists(public_path($agenda->foto))) {
                File::delete(public_path($agenda->foto));
            }

            $ext      = strtolower($file->getClientOriginalExtension()) ?: 'jpg';
            $filename = 'agenda_' . time() . '_' . uniqid() . '.' . $ext;
            $file->move(public_path('image/agenda'), $filename);
            $agenda->foto = 'image/agenda/' . $filename;
        }

        $agenda->judul   = $validated['judul'];
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

    /**
     * Ambil file upload foto (coba field 'foto' dulu, lalu 'gambar').
     * Kembalikan null jika tidak ada file atau upload gagal.
     */
    private function getUploadedFoto(Request $request): ?\Illuminate\Http\UploadedFile
    {
        foreach (['foto', 'gambar'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                if ($file->isValid() && $file->getSize() > 0) {
                    return $file;
                }
            }
        }
        return null;
    }

    /**
     * Validasi ukuran file dan ekstensi.
     */
    private function validateFile(\Illuminate\Http\UploadedFile $file): void
    {
        if ($file->getSize() > self::MAX_SIZE_BYTES) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'foto' => ['Ukuran foto tidak boleh lebih dari 3 MB.'],
            ]);
        }

        $ext = strtolower($file->getClientOriginalExtension());
        if (!in_array($ext, self::ALLOWED_EXTENSIONS)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'foto' => ['Format foto tidak didukung. Gunakan: ' . implode(', ', self::ALLOWED_EXTENSIONS) . '.'],
            ]);
        }
    }
}
