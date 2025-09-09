<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Tambahkan ini di bagian atas
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
    $users = User::all(); // Mengambil semua data user
    return view('users.index', compact('users')); 
    }
    public function create()
    {
        return view('users.create'); // sesuai dengan blade yang sudah kamu buat
    }

    // simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nip'      => 'required|string|max:50|unique:users,nip',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:Super Admin,Admin',
        ]);

        User::create([
            'name'     => $request->name,
            'nip'      => $request->nip,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // enkripsi password
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('users.edit', compact('users'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nip'      => 'required|string|max:50|unique:users,nip,' . $id,
            'email'    => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|string|in:Super Admin,Admin',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->nip = $request->nip;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // enkripsi password
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate!');
    }

    public function akun()
    {
        return view('users.akun');
    }

    public function updateAkun(Request $request)
    {
    $user = auth()->user();

    $request->validate([
        'name'  => 'required|string|max:255',
        'nip'   => 'required|string|max:50|unique:users,nip,' . $user->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'avatar'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:800',
    ]);

    $user->name = $request->name;
    $user->nip = $request->nip;
    $user->email = $request->email;

    if ($request->hasFile('avatar')) {
        // hapus foto lama jika ada
         if ($user->avatar && file_exists(public_path('image/users/' . $user->avatar))) {
            unlink(public_path('image/users/' . $user->avatar));
        }

    $path = $request->file('avatar')->store('/image/users/', 'public');
    $user->avatar = $path;
    }

    $user->save();

    return redirect()->route('users.akun')->with('success', 'Profil berhasil diperbarui!');
    }
}