<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Organigram;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalAnggota = Anggota::count();
        $totalAgenda = Agenda::count();
        $totalOrganigram = Organigram::count();
        $totalUser = User::count();

        $beritaTerbaru = Berita::orderByDesc('tanggal')->take(5)->get();
        $agendaTerdekat = Agenda::orderByDesc('tanggal')->take(5)->get();
        $anggotaTerbaru = Anggota::orderByDesc('id')->take(5)->get();

        $dbName = DB::getDatabaseName();

        return view('backend.dashboard', compact(
            'totalBerita',
            'totalAnggota',
            'totalAgenda',
            'totalOrganigram',
            'totalUser',
            'beritaTerbaru',
            'agendaTerdekat',
            'anggotaTerbaru',
            'dbName'
        ));
    }
}
