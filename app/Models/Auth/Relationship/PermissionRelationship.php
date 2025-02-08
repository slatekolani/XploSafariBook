<?php

namespace App\Models\Auth\Relationship;

use App\Models\Auth\Role;
use App\Models\Auth\User;

/**
 * Class PermissionRelationship
 * @package App\Models\Access\Relationship
 */
trait PermissionRelationship
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}