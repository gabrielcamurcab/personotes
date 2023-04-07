<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\ResetPasswordTokenInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Str;

class  AuthService {
    public function login(string $email, string $password) {

        $login = [
            'email' => $email,
            'password' => $password
        ];

        if(!$token = auth()->attempt($login)) {
            throw new LoginInvalidException();
        }else {
            return [
                'access-token' => $token,
                'token_type' => 'Bearer',
            ];
        }

    }
}