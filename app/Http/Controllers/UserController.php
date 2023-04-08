<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return new UserResource(Auth::user());
    }

    public function update(UserUpdateRequest $request) {
        $input = $request->validated();
        $user = (new UserService())->update(Auth::user(), $input);

        return new UserResource($user);
    }
}
