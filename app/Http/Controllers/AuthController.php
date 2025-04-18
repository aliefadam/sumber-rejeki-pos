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
            return back()->with("notification", setNotification("error", "Gagal", "Email atau password salah"));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
