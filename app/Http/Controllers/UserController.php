<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $loginInfo = $request->validate([
            'login-name' => 'required',
            'login-password' => 'required',
        ]);

        if (Auth::attempt([
            'name' => $loginInfo['login-name'],
            'password' => $loginInfo['login-password'],
        ])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth::login($user);
        return redirect('/');
    }
}
