<?php

namespace App\Http\Controllers;

use App\Exceptions\UserHasBeenTakenException;
use App\Http\Requests\RegisterRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(RegisterRequest $request) {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([
                'password' => 'A senha deve ter pelo menos uma letra maiúscula, uma letra minúscula e um número.'
            ])->withInput();
        }

        $input = $request->validated();

        $user = User::where('email', $request['email'])->exists();
        if (!empty($user)){
            return back()->withErrors([
                'email' => 'O email informado já está em uso.',
            ])->withInput();
        }

        $pass = bcrypt($input['password']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $pass,
        ]);

        Mail::to($user->email)->send(new WelcomeMail($user));

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
            'email' => 'O email/senha inseridos estão incorretos.',
        ])->onlyInput('email');
    }

    public function logout() {
        Auth::logout();

        return redirect()->intended('login');
    }
}
