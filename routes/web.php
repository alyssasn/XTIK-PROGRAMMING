<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrganigramController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to beranda
Route::get('/', function () {
    return redirect()->route('beranda');
});

// Frontend Public Routes
Route::get('/beranda', [FrontendController::class, 'beranda'])->name('beranda');
Route::get('/profil', [FrontendController::class, 'profil'])->name('profil');
Route::get('/organigram', [FrontendController::class, 'organigram'])->name('organigram');
Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
Route::get('/anggota', [FrontendController::class, 'anggota'])->name('anggota');
Route::get('/agenda', [FrontendController::class, 'agenda'])->name('agenda');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.post');

Route::get('/user', function () {
    return redirect()->route('login');
})->name('user');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Backend Admin Protected Routes
Route::prefix('backend')
    ->name('backend.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profil', [ProfilController::class, 'edit'])
            ->name('profil');

        Route::put('/profil', [ProfilController::class, 'update'])
            ->name('profil.update');

        Route::get('/profil-admin', [AdminProfileController::class, 'index'])
            ->name('profil_admin');

        Route::put('/profil-admin', [AdminProfileController::class, 'update'])
            ->name('profil_admin.update');

        Route::resource('organigram', OrganigramController::class)
            ->parameters(['organigram' => 'organigram'])
            ->except(['show']);

        Route::resource('berita', BeritaController::class)
            ->parameters(['berita' => 'berita'])
            ->except(['show']);

        Route::resource('anggota', AnggotaController::class)
            ->parameters(['anggota' => 'anggota'])
            ->except(['show']);

        Route::resource('agenda', AgendaController::class)
            ->parameters(['agenda' => 'agenda'])
            ->except(['show']);

        Route::resource('user', UserController::class)
            ->parameters(['user' => 'user'])
            ->except(['show']);
    });
