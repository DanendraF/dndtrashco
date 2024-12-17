<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Cek apakah kredensial login benar
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Ambil user yang baru login
            $user = Auth::user();

            // Cek apakah user adalah admin
            if ($user->role == 'admin') {
                return redirect()->route('admin.userlist'); // Arahkan ke admin.userlist
            }

            // Jika bukan admin, arahkan ke home
            return redirect()->route('home');
        }

        // Jika kredensial salah, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
