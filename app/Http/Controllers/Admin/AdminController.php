<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Staff\StaffResetPassword;
use App\Http\Requests\Staff\StaffUpdateRequest;
use App\Repositories\Access\RoleRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Port\PortRepository;
use App\Repositories\Staff\DesignationRepository;
use App\Repositories\Staff\StaffRepository;
use App\Repositories\Staff\UnitRepository;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Repositories\System\ZoneRepository;
use App\Repositories\Workflow\WfModuleGroupRepository;

class AdminController extends Controller
{


    public function __construct()
    {

    }

    /*Open Admin dashboard menu*/
    public function index()
    {
        return view('admin/dashboard_menu');
    }


    /*Open System menu*/
    public function systemMenu()
    {
        return view('admin/system/index');
    }



}
