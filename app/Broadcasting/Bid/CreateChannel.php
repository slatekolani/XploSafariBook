<?php

namespace App\Broadcasting\Bid;

use App\Models\Auth\User;
use Illuminate\Broadcasting\InteractsWithSockets;

class CreateChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\Auth\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        //
    }
}
