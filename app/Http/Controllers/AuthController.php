<?php

namespace App\Http\Controllers;

use App\Exceptions\UserHasBeenTakenException;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(RegisterRequest $request) {
        $input = $request->validated();

        $user = User::where('email', $request['email'])->exists();
        if (!empty($user)){
            throw new UserHasBeenTakenException;
        }

        $pass = bcrypt($input['password']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $pass,
        ]);

        return redirect()->route('login');
    }
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('notes');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout() {
        Auth::logout();

        return redirect()->intended('login');
    }
}
