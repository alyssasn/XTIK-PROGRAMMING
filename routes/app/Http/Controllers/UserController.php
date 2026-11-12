<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return $this->renderIndex(null);
    }

    public function create()
    {
        return $this->renderIndex(null);
    }

    public function edit(User $user)
    {
        return $this->renderIndex($user);
    }

    private function renderIndex(?User $editData)
    {
        $users = User::orderBy('username')->paginate(10);

        return view('backend.user', [
            'users' => $users,
            'editData' => $editData,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:tbl_login,username'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $name = !empty($request->input('name')) ? $request->input('name') : $validated['username'];
        $email = !empty($request->input('email')) ? $request->input('email') : ($validated['username'] . '@xtik.com');

        User::create([
            'name' => $name,
            'username' => $validated['username'],
            'email' => $email,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('backend.user.index')->with('success', 'User admin berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('tbl_login', 'username')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->username = $validated['username'];
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        } elseif (empty($user->name)) {
            $user->name = $validated['username'];
        }

        if ($request->filled('email')) {
            $user->email = $request->input('email');
        } elseif (empty($user->email)) {
            $user->email = $validated['username'] . '@xtik.com';
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('backend.user.index')->with('success', 'Data user admin berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('backend.user.index')->with('error', 'Anda tidak dapat menghapus akun yang sedang Anda gunakan.');
        }

        if (User::count() <= 1) {
            return redirect()->route('backend.user.index')->with('error', 'Minimal harus ada satu akun administrator.');
        }

        $user->delete();

        return redirect()->route('backend.user.index')->with('success', 'User admin berhasil dihapus.');
    }
}
