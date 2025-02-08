<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Http\Requests\Access\RoleRequest;
use App\Models\Auth\Permission;
use App\Models\Auth\PermissionGroup;
use App\Models\Auth\Role;
use App\Repositories\Access\PermissionRepository;
use App\Repositories\Access\RoleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{


    protected $roles;


    public function __construct()
    {
        $this->roles = new RoleRepository();

        /*Permissions*/

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return  view('access/role/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return  view('access/role/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        //

        $input = $request->all();
        $role = $this->roles->store($input);
        return redirect()->route('access.role.edit',$role->id )->withFlashSuccess(trans('alert.general.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $iduse Yajra\DataTables\DataTables;
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $permission_groups = PermissionGroup::query()->orderBy('name')->get();
        $permission_repo = new PermissionRepository();
        if($role->isadmin == 1){
            $permissions = $permission_repo->getAll();
        }else{
            $permissions =$permission_repo->getAllNonAdministrative();
        }

        return  view('access/role/edit/edit')
            ->with('role', $role)
            ->with('permission_groups', $permission_groups)
            ->with('permissions', $permissions)
            ->with('first_permission_group', PermissionGroup::query()->orderBy('name')->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        //

        $this->roles->update($request->all(), $role);
        return redirect()->route('access.role.index')->withFlashSuccess(trans('alert.general.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Get roles for data table
     */
    public function getRolesForDataTable()
    {
        return DataTables::of($this->roles->getRolesForDataTable())
            ->addIndexColumn()
            ->editColumn('isadmin', function ($role) {
                return $role->is_admin_label;
            })
            ->addColumn('actions', function ($role) {
                return $role->edit_button;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


}
