<?php

namespace App\Repositories\Access;


use App\Models\Auth\Role;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository
{
    const MODEL = Role::class;


    public function  getDetail($id){

        $role = $this->query()->where('id', $id)->first();
        return $role;
    }

    public function forSelect()
    {
        return $this->queryActive()->pluck('name', 'id');
    }

    /*Get Administrative roles for select*/
    public function getAdministrativeRolesForSelect()
    {
        return $this->queryActive()->select(['id', 'name'])->where("isadmin", 1)->orderBy("id", "asc")->get()->pluck("name", "id");
    }

    public function getNonAdministrativeRolesForSelect()
    {
        return $this->queryActive()->select(['id', 'name'])->where("isadmin", 0)->orderBy("id", "asc")->get()->pluck("name", "id");
    }

    /*Get roles for Datatable*/
    public function getRolesForDataTable()
    {
        return $this->query();
    }


    /**
     * @param array $input
     * @return mixed
     * Store new role
     */
    public function store(array $input)
    {
        return  DB :: transaction(function() use ($input){
            $role = $this->query()->create([
                'id' => $this->getNextId(),
                'name' => $input['name'],
                'description' => $input['description'],
                'isadmin' => isset($input['isadmin']) ? $input['isadmin'] : 0,
            ]);
            return $role;
        });
    }



    /*Update Role and Permissions */
    public function update(array $input, Model $role)
    {
        return  DB :: transaction(function() use ($input, $role){
            $this->updateRole($input, $role);
            $this->updateRolePermissions($input, $role);
            return $role;
        });

    }


    /*Update role info to Role table*/
    public function updateRole(array $input, Model $role)
    {
        return  DB :: transaction(function() use ($input, $role){
            $role->update([
                'name' => $input['name'],
                'description' => $input['description'],
                'isadmin' => isset($input['isadmin']) ? $input['isadmin'] : 0,
            ]);
            return $role;
        });
    }


    /*Update sync permissions with role*/
    public function updateRolePermissions(array $input, Model $role)
    {
        return  DB :: transaction(function() use ($input, $role){
            $permissions = [];

            foreach ($input as $key => $value) {
                if (strpos($key, 'permission') !== false) {
                    $permission_id = substr($key, 10);
                    array_push($permissions, $permission_id);
                }
            };

            $role->permissions()->sync($permissions);

            return $role;
        });
    }


    /*Get The max id*/
    public function getMaxId()
    {
        return $this->query()->max('id');
    }

    /*Get the next id to be used on the new entry*/
    public function getNextId()
    {
        return $this->getMaxId() + 1;
    }



}
