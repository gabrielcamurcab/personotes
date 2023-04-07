<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index() {
        return new UserResource(auth()->user());
    }

    public function update(UserUpdateRequest $request) {
        $input = $request->validated();
        $user = (new UserService())->update(auth()->user(), $input);

        return new UserResource($user);
    }
}
