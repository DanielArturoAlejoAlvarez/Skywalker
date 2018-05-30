<?php

namespace Skywalker\Policies;

use Skywalker\User;
use Illuminate\Auth\Access\HandlesAuthorization;

//my uses
use Skywalker\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function pass(User $user, Post $post){
        return $user->id == $post->user_id;
    }
}
