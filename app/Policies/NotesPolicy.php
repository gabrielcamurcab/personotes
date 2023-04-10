<?php

namespace App\Policies;

use App\Models\Notes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class NotesPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Notes $notes) {
        return $user->id === $notes->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
    }

    public function update(User $user, Notes $notes) {
        return $user->id === $notes->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
    }

    public function delete(User $user, Notes $notes) {
        return $user->id === $notes->user_id;
    }
}
