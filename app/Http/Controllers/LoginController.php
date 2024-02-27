<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // encriptación password

        $user->save();

        // al habernos registrado nos inicia sesión automáticamente
        Auth::login($user);

        return redirect('index');
    }
    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        $remember = ($request->has('remember') ? true : false); // "mantener sesión iniciada"

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->put('usuario', Auth::user());
            return redirect()->intended(); // intended = por si se intentó entrar a una web protegida por middleware
        } else {
            return redirect("login");
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');

    }
}