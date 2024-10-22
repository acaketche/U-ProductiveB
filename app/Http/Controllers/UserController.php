<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function kelolaUser()
        {
            {
                $users = User::all();
                return view('admin.kelola-user', compact('users'));
            }
        }

        public function destroy($id)
        {
            $users = User::findOrFail($id);
            $users->delete();

            return redirect()->route('kelola.user')->with('success', 'Kategori berhasil dihapus.');
        }

        public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Mendapatkan user yang sedang login
        $user = Auth::user(); // Pastikan menggunakan Auth dengan benar
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password lama diisi, verifikasi dan update password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
            }

            $user->password = Hash::make($request->new_password);
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Profile berhasil diperbarui');
    }
}

