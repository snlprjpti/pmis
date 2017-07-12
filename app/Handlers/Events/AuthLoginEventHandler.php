<?php

namespace Pmis\Handlers\Events;

use Pmis\Eloquent\User;

class AuthLoginEventHandler
{
    /**
     * Handle the event.
     *
     * @param User $user
     * @param $remember
     */
    public function handle(User $user, $remember)
    {
        $user->last_login = new \DateTime();
        $user->login_count = $user->login_count + 1;
        $user->save();
    }
}
