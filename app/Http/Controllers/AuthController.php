<?php

namespace App\Http\Controllers;

use App\Exceptions\UserHasBeenTakenException;
use App\Http\Requests\RegisterRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
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
        if (!empty($user)) {
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

        return view('login', ['message' => 'Conta criada com sucesso! Verifique seu e-mail.']);
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

    public function logout()
    {
        Auth::logout();

        return redirect()->intended('login');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => 'Um link de redefinição foi enviado para seu email!'])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('message', 'Senha redefinida com sucesso!')
                : back()->withErrors(['email' => [__($status)]]);
    }
}
