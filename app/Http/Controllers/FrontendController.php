<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Organigram;
use App\Models\Profil;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function beranda()
    {
        $profil = Profil::first();
        $beritas = Berita::orderByDesc('tanggal')->take(3)->get();
        $agendas = Agenda::orderByDesc('tanggal')->take(3)->get();
        $totalAnggota = Anggota::count();
        $organigrams = Organigram::all();

        return view('frontend.beranda', compact('profil', 'beritas', 'agendas', 'totalAnggota', 'organigrams'));
    }

    public function profil()
    {
        $profil = Profil::first();

        return view('frontend.profil', compact('profil'));
    }

    public function organigram()
    {
        $organigrams = Organigram::all();

        return view('frontend.organigram', compact('organigrams'));
    }

    public function berita(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('cari') || $request->filled('q')) {
            $search = $request->input('cari') ?: $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && $request->input('kategori') !== 'semua') {
            $kat = $request->input('kategori');
            $query->where(function ($q) use ($kat) {
                $q->where('judul', 'like', "%{$kat}%")
                  ->orWhere('isi', 'like', "%{$kat}%");
            });
        }

        $beritas = $query->orderByDesc('tanggal')->paginate(6)->withQueryString();

        $kategoris = [
            'semua' => 'Semua',
            'workshop' => 'Workshop & Pelatihan',
            'kegiatan' => 'Kegiatan Ekskul',
            'prestasi' => 'Prestasi',
            'teknologi' => 'Teknologi & Coding',
        ];

        return view('frontend.berita', compact('beritas', 'kategoris'));
    }

    public function anggota(Request $request)
    {
        $query = Anggota::query();

        if ($request->filled('cari') || $request->filled('q')) {
            $search = $request->input('cari') ?: $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kelas') && $request->input('kelas') !== '') {
            $query->where('kelas', $request->input('kelas'));
        }

        if ($request->filled('jurusan') && $request->input('jurusan') !== '') {
            $query->where('jurusan', $request->input('jurusan'));
        }

        if ($request->filled('tingkat') && $request->input('tingkat') !== 'semua') {
            $tingkat = $request->input('tingkat');
            if ($tingkat === 'X') {
                $query->where('kelas', 'like', 'X %')->orWhere('kelas', 'like', 'X-%')->orWhere('kelas', 'like', 'X_%');
            } elseif ($tingkat === 'XI') {
                $query->where('kelas', 'like', 'XI %')->orWhere('kelas', 'like', 'XI-%');
            } elseif ($tingkat === 'XII') {
                $query->where('kelas', 'like', 'XII %')->orWhere('kelas', 'like', 'XII-%');
            }
        }

        $anggotas = $query->orderBy('nama')->paginate(10)->withQueryString();
        $totalAnggota = Anggota::count();

        $daftarKelas = Anggota::select('kelas')->distinct()->whereNotNull('kelas')->orderBy('kelas')->pluck('kelas');
        $daftarJurusan = Anggota::select('jurusan')->distinct()->whereNotNull('jurusan')->orderBy('jurusan')->pluck('jurusan');

        return view('frontend.anggota', compact('anggotas', 'totalAnggota', 'daftarKelas', 'daftarJurusan'));
    }

    public function agenda(Request $request)
    {
        $query = Agenda::query();

        if ($request->filled('cari') || $request->filled('q')) {
            $search = $request->input('cari') ?: $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $status = $request->input('status', 'semua');
        $today = now()->toDateString();

        if ($status === 'mendatang') {
            $query->where('tanggal', '>=', $today);
        } elseif ($status === 'selesai') {
            $query->where('tanggal', '<', $today);
        }

        $agendas = $query->orderByDesc('tanggal')->paginate(6)->withQueryString();

        return view('frontend.agenda', compact('agendas', 'status'));
    }
}
