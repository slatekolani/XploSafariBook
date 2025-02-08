<?php

namespace App\Models\Auth\Relationship;

use App\Models\Auth\Permission;
use App\Models\Auth\User;
use App\Models\System\RoleCharge;

/**
 * Class RoleRelationship
 * @package App\Models\Access\Relationship
 */
trait RoleRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function permissions()
    {

        return $this->belongsToMany(Permission::class)
            ->orderBy('name', 'asc')->withTimestamps();

    }



}