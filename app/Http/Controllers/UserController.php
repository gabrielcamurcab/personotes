<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
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

        if(!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
            User::where('id', Auth::user()->id)->update(
                [
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => $input['password'],
                ]);
        }else {
            User::where('id', Auth::user()->id)->update(
                [
                    'name' => $input['name'],
                    'email' => $input['email'],
                ]);
        }

        return redirect()->intended('notes');
    }

    public function updateuser() {
        $users = UserResource::collection(User::where('id', Auth::id())->get());

        return view('userupdate', ['users' => $users]);
    }
}
