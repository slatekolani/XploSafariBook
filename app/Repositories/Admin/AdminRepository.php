<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/11/19
 * Time: 12:27 PM
 */

namespace App\Repositories\Admin;

use App\Models\Staff\Staff;
use App\Repositories\Access\UserRepository;
use App\Repositories\BaseRepository;
use App\Repositories\Staff\StaffRepository;
use Illuminate\Support\Facades\DB;

class AdminRepository extends BaseRepository
{

    protected $user_repo;


    public function __construct()
    {
        $this->user_repo = new UserRepository();

    }

}
