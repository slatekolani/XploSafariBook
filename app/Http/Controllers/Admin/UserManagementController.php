<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterSystemUserRequest;
use App\Http\Requests\Admin\UpdateSystemUserRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use Illuminate\Http\Request; 
use App\Models\Auth\PermissionGroup;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Repositories\Access\PermissionRepository;
use App\Repositories\Access\RoleRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Admin\UserManagementRepository;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{

    protected $user_repo;

    public function __construct()
    {
        $this->user_repo = new UserManagementRepository();

    }

    /*Manage users*/
    public function index()
    {
        return view('admin/users/menu');
    }


    /*System Users list*/
    public function systemUsersList()
    {
        return view('admin/users/system_users/index');
    }



    /**
     * Create system user by Admin
     */
    public function createSystemUser()
    {
        $roles = Role::query()->pluck('name','id');
        return view('admin/users/system_users/create/create')
            ->with('roles', $roles);
    }


    /*Store system user*/

    public function storeSystemUser(RegisterSystemUserRequest $request)
    {
        $input = $request->all();
        $this->user_repo->storeSystemUser($input);
        return redirect()->route('admin.user_manage.system_users')->withFlashSuccess(trans('alert.general.created'));
    }


    /*Edit system user*/
    public function editSystemUser(User $user)
    {
        $roles = Role::query()->pluck('name','id');
        return view('admin/users/system_users/edit/edit')
            ->with('user', $user)
            ->with('roles', $roles);

    }

    /*Update system user*/
    public function updateSystemUser(User $user,UpdateSystemUserRequest $request )
    {
        $input = $request->all();
        $this->user_repo->updateSystemUser($user, $input);
        return redirect()->route('admin.user_manage.system_users')->withFlashSuccess(trans('alert.general.updated'));
    }
    // activate user status
    public function activateUserStatus(Request $request)
    {
        $user=User::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $user->status=1;
                break;
            case 1:
                $user->status=0;
                break;
        }
        $user->save();
        return response()->json(['success'=>true]);

    }

    /*Get users for DataTable*/
    public function getSystemUsersForDt()
    {
        return DataTables::of($this->user_repo->getSystemUsersForDt())
            ->addIndexColumn()
            ->addColumn('username', function ($user) {
                return $user->username;
            })
            ->addColumn('created_date', function ($user) {
                return ($user->created_at);
            })
            ->addColumn('activateUserStatus',function ($user){
                $btn='<label class="switch{{$user->status}}">
                <input type="checkbox">
                <span class="slider round"></span>
              </label>';
                return $btn;
            })
            ->addColumn('userStatus', function ($user) {
                return $user->UserStatusLabel;
            })
            ->addColumn('role_label', function ($user) {
                return $user->UserRoleLabel;
            })
            ->addColumn('actions',function($user){
                return $user->UserActionButtonsLabel;
            })
            ->rawColumns(['role_label', 'userStatus','activateUserStatus','actions'])
            ->make(true);
    }
}
