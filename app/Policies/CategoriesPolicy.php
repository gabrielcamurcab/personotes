<?php

namespace App\Policies;

use App\Models\Categories;
use App\Models\User;

class CategoriesPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Categories $categorie) {
        return $user->id === $categorie->user_id;
    }

    public function update(User $user, Categories $categorie) {
        return $user->id === $categorie->user_id;
    }
}
