<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login", [
            "title" => "Login",
        ]);
    }

    public function login_post(Request $request)
    {
        if (Auth::attempt($request->only(["email", "password"]))) {
            $role = Auth::user()->role;
            return redirect()->route("admin.dashboard");
        } else {
            return back()->with("notification", setNotification("error", "Gagal", "Email atau password salah"))->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }

    public function change_password()
    {
        return view("auth.change-password", [
            "title" => "Ubah Password",
        ]);
    }

    public function change_password_post(Request $request)
    {
        $request->validate([
            "password_old" => "required|current_password",
            "password" => "required|confirmed",
        ], [
            "password_old.required" => "Password lama harus diisi",
            "password_old.current_password" => "Password lama salah",
            "password.required" => "Password baru harus diisi",
            "password.confirmed" => "Konfirmasi password baru tidak sama",
        ]);

        $user = User::find(Auth::user()->id);
        $user->update([
            "password" => bcrypt($request->password)
        ]);

        Auth::logout();
        return redirect_user("success", "Berhasil mengubah password, silahkan login kembali", "login");
    }
}
