<?php

namespace App\Services\Access;

use App\Exceptions\GeneralException;
use App\Repositories\Workflow\WfTrackRepository;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class Access.
 */
class Access
{
    /**
     * Get the currently authenticated user or null.
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * Return if the current session user is a guest or not.
     *
     * @return mixed
     */
    public function guest()
    {
        return auth()->guest();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * Get the currently authenticated user's id.
     *
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }


    /**
     * Get the currently authenticated user's  uuid.
     *
     * @return mixed
     */
    public function uuid()
    {
        return $this->user()->uuid;
    }

    /**
     * @param Authenticatable $user
     * @param bool            $remember
     */
    public function login(Authenticatable $user, $remember = false)
    {
        $logged_in = auth()->login($user, $remember);
        return $logged_in;
    }

    /**
     * Check whether user is authenticated or not ...
     *
     * @return bool
     */
    public function check()
    {
        return auth()->check();
    }

    public function viaRemember()
    {
        return auth()->viaRemember();
    }





    /**
     * Return all users
     * @return array
     */
    public function allUsers()
    {
        $return = [];
        $user = $this->user();
//        if ($this->substitutingCount()) {
//            $return = $user->substitutingUsers()->select(['id'])->pluck("id")->toArray();
//        }
        $return[] = $this->id();
        return $return;
    }


    /**
     * Check if the current user has a permission by its name or id.
     *
     * @param string $permission Permission name or id.
     *
     * @return bool
     */
    public function allow($permission)
    {
        $return = false;
        if ($user = $this->user()) {
            $return = $user->allow($permission);
        }else{
            /*Allow guest*/

        }

        return $return;
    }


}
