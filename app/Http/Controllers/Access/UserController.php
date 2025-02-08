<?php

namespace App\Http\Controllers\Access;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Requests\Request;
use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\System\DocumentRepository;
use App\Repositories\System\DocumentResourceRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    protected $user_repo;

    /*Construct*/
    public function __construct()
    {
        $this->user_repo = new UserRepository();
    }


    /*User profile*/
    public function profile(User $user)
    {
        $this->checkIfIsOwnerGeneral($user->id, access()->id());
        return view('access/user/profile/profile')
            ->with('user', $user);


    }

    /*Edit user*/
    public function edit(User $user)
    {
        $this->checkIfIsOwnerGeneral($user->id, access()->id());
        return view('access/user/edit/edit')
            ->with('user', $user);
    }

    /*Update user*/
    public function update(User $user, UpdateUserRequest $request)
    {
        $input = $request->all();
        $this->user_repo->update($user, $input);
        return redirect()->route('user.profile', $user->uuid)->withFlashSuccess(__('alert.user.updated'));
    }

    /*change password*/
    public function changePassword(User $user, ChangePasswordRequest $request)
    {
        $input = $request->all();
        $this->user_repo->changePassword($user, $input);
        return redirect()->back()->withFlashSuccess(__('alert.auth.change_password'));
    }
    


}
