<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Mahasiswa,Dosen,Admin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('name', $request-> input('name'))->first();

        if ($user) {
            return redirect()-> back()->withErrors(['name'=> 'Username sudah digunakan'])->withinput();
        }
        // Create new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>$request->input('password'),
            'role' => $request->input('role'),
        ]);

        // Log in the user
        Auth::login($user);
        return redirect()->route('login')->with('success', 'Pendaftaran user berhasil! Silahkan lakukan login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil input name dan password
        $credentials = $request->only('name', 'password');
        Log::info('Login attempt', $credentials);

        // Cari user berdasarkan name
        $user = User::where('name', $credentials['name'])->first();

        // Verifikasi user dan password
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Set session untuk login user
            auth()->login($user);

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Cek role dan redirect ke halaman sesuai
            if ($user->hasRole('admin')) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->hasRole('mahasiswa')) {
                return redirect()->intended('/userprofile');
            } elseif ($user->hasRole('dosen')) {
                return redirect()->intended('/userprofile');
            } else {
                return redirect()->intended('/home');
            }

        // Jika login gagal
        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->onlyInput('name');
    }
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
