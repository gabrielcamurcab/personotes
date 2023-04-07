<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

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

        return redirect()->route('index');
    }

    public function login(LoginRequest $request){
        $input = $request->validated();

        $token = $this->authService->login($input['email'], $input['password']);
        return (new UserResource(auth()->user()))->additional($token);

    }
}
