<?php


namespace App\Repositories\Access;


use App\Models\Auth\Permission;
use App\Models\Auth\User;
use App\Repositories\BaseRepository;


class PermissionRepository extends BaseRepository
{

    const  MODEL = Permission::class;

    /*Get all permissions*/
    public  function  getAll()
    {
        return $this->query()->orderBy('display_name')->get();

    }

/*Get all permissions which are non administrative*/
    public function getAllNonAdministrative()
    {
        return $this->query()->where('isadmin', 0)->orderBy('display_name')->get();
    }




    /*Check if permission is in user roles*/
    public function checkIfPermissionIsInUserRoles($user_id, $permission_id)
    {
        $user = User::query()->find($user_id);
        $check = $user->roles()->whereHas('permissions', function($query) use($permission_id){
            $query->where('permissions.id', $permission_id);
        })->count();
        if($check > 0)
        {
            return true;
        }else{
            return false;
        }
    }
}