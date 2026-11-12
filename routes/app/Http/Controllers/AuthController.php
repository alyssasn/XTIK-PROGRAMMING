<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin.
     */
    public function showLogin()
    {
        return view('frontend.user');
    }

    /**
     * Proses login admin.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username atau email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $loginInput = $credentials['username'];
        $password = $credentials['password'];

        // Cek apakah input berupa email atau username
        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $loginInput, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('backend.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . (Auth::user()->name ?? 'Admin') . '!');
        }

        // Coba alternatif field lain (jika tadi dicari via username tapi ada di email atau sebaliknya)
        $altField = ($field === 'email') ? 'username' : 'email';
        if (Auth::attempt([$altField => $loginInput, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('backend.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . (Auth::user()->name ?? 'Admin') . '!');
        }

        return back()
            ->withErrors(['username' => 'Username/email atau password yang Anda masukkan salah.'])
            ->onlyInput('username');
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda')->with('success', 'Anda berhasil logout.');
    }
}
