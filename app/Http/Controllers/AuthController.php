<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $input = $request->validated();
        $pass = bcrypt($input['password']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $pass,
        ]);

        return redirect()->route('index');
    }
}
