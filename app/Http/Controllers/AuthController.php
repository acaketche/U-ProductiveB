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
            'password' => Hash::make($request->input('password')),
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
    try {
        $credentials = $request->only('name', 'password',);
        Log::info('Login attempt', $credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect based on user role
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('dosen')) {
                return redirect()->route('user.profile');
            } elseif ($user->hasRole('mahasiswa')) {
                return redirect()->route('user.profile');
            } else {
                Log::warning('Unknown role for user', ['user_id' => $user->id]);
                return redirect()->route('home')->withErrors(['authError' => 'Role tidak dikenal']);
            }
        } else {
            Log::warning('Login failed', $credentials);
            return redirect()->back()->withErrors(['authError' => 'Username atau password salah'])->withInput();
        }
    } catch (\Exception $e) {
        Log::error("Error during sign in: " . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan server. Silahkan coba kembali.'])->withInput();
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
