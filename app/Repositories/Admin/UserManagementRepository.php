<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/11/19
 * Time: 12:27 PM
 */

namespace App\Repositories\Admin;

use App\Models\Auth\User;
use App\Repositories\Access\UserRepository;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserManagementRepository extends BaseRepository
{

    const MODEL = User::class;

    public function __construct()
    {


    }

    /*Store System user*/
    public function storeSystemUser(array $input)
    {
        $user = DB::transaction(function () use ($input) {
            $user = $this->saveUser($input);

            /*Role*/
            // $this->attachRolePermissions($input, $user);

            /*send registration notification*/
            (new UserRepository())->sendRegistrationNotification($user);

            return $user;
        });
        return $user;
    }


    /*Save user information*/
    public function saveUser(array $input)
    {
      
        $user = DB::transaction(function () use ($input) {
            $input['confirmation_code'] = mt_rand(100000,999999);
            $input['password'] = bcrypt($input['password']);
            $user = $this->query()->create([
                'username' => $input['username'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'password' => $input['password'],
                'confirmation_code' => $input['confirmation_code'],
                'role' => $input['role_id'],
            ]);
            return $user;
        });

        return $user;
    }



    /*Update System user*/
    public function updateSystemUser(Model $user,array $input)
    {
        $user = DB::transaction(function () use ($user, $input) {
            $user = $this->editUser($user, $input);

        });
        return $user;
    }

    /*Edit user system*/
    public function editUser(Model $user,  array $input)
    {
        /*CHeck if phone is unique TODO: on phone check if country code is changing*/

        /*end check phone*/
        $user = DB::transaction(function () use ($user,$input) {
            $user->update([
                'username' => $input['username'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'role' => $input['role_id'],
            ]);
            return $user;
            
        });

        return $user;
    }





    /*Attach roles and permissions*/
    public function attachRolePermissions(array $input, Model $user)
    {
        $user_repo = new UserRepository();
        /*Attach roles*/
        $user_repo->attachRoles($input, $user);
        /*Attach permissions based on the roles assigned*/
//        $user_repo->attachRolePermissions($user);
    }


    /*Sync additional permissions for specific system user*/
    public function syncAdditionalUserPermissions(array $input, Model $user)
    {
        return  DB :: transaction(function() use ($input, $user){
            $permissions = [];
            foreach ($input as $key => $value) {
                if (strpos($key, 'permission') !== false) {
                    $permission_id = substr($key, 10);
                    array_push($permissions, $permission_id);
                }
            };

            $user->permissions()->sync($permissions);

            return $user;
        });
    }


    /*Reset password by admin*/
    public function resetPasswordByAdmin($input, $uuid)
    {
        $password = [
            'password' => bcrypt($input['password'])
        ];
        return DB::transaction(function () use($password, $uuid) {
            $user = $this->getOneByUuid($uuid);
            $user->update($password);
            return $user;
        });
    }



    /*Get System users for DataTable*/
    public function getSystemUsersForDt()
    {
        return $this->query();
    }

}
