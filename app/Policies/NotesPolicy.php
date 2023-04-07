<?php

namespace App\Policies;

use App\Models\Notes;
use App\Models\User;

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
        return $user->id === $notes->user_id;
    }

    public function update(User $user, Notes $notes) {
        return $user->id === $notes->user_id;
    }

    public function delete(User $user, Notes $notes) {
        return $user->id === $notes->user_id;
    }
}
