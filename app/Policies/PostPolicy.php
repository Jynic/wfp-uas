<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function delete(User $user)
    {
        return ($user->role == "manager") ?
            Response::allow() :
            Response::deny("Only managers are allowed to perform this operation");
    }
}
