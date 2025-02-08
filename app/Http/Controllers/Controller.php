<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * CUSTOM FUNCTIONS -- Nextbyte
     */

    /**
     * Check if user is the owner (the one created) - when opening profiles/dashboard
     */
    public function checkIfUserIsOwner(Model $model)
    {
        $user = access()->user();
        if ($user->id != $model->user_id)
        {
            throw new GeneralException(__('exceptions.general.owner_restriction'));
        }
    }


    /**
     * Check if admin is Owner
     */
    public function checkIfAdminIsOwner()
    {
        $user = access()->user();
        if ($user->user_account_type != 1){
            throw new GeneralException(__('exceptions.general.admin_restriction'));
        }
    }


    /**
     * @param $param1
     * @param $param2
     * @throws GeneralException
     * Check if owner by comparing parameters
     */
    public function checkIfIsOwnerGeneral($param1, $param2)
    {
        try {
            if ($param1 == $param2) {
                //ok
            } else {
                //not owner
                throw new GeneralException(__('exceptions.general.owner_restriction'));
            }

        } catch (\Exception $exception) {
            throw new GeneralException(__('exceptions.general.owner_restriction'));
        }
    }


}
