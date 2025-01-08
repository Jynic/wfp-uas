<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

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
        return ($user->role == "manager" || $user->role == "admin") ?
            Response::allow() :
            Response::deny("Only managers and admins are allowed to perform this operation");
    }
}
