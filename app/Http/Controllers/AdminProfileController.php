<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    /**
     * Tampilkan halaman profil admin.
     */
    public function index()
    {
        $user = Auth::user();

        return view('backend.profil_admin', compact('user'));
    }

    /**
     * Perbarui data profil dan akun admin.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('tbl_login', 'username')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('tbl_login', 'email')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan oleh user lain.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan oleh user lain.',
            'password.min' => 'Password baru minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'current_password.required_with' => 'Masukkan password saat ini untuk mengganti password.',
        ]);

        if (!empty($validated['password'])) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
            }

            $user->password = Hash::make($validated['password']);
        }

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('backend.profil_admin')->with('success', 'Profil admin berhasil diperbarui.');
    }
}