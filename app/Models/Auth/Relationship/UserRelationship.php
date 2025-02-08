<?php

namespace App\Models\Auth\Relationship;

use App\Models\Application\PVoC\Application\PVoCApplication;
use App\Models\Application\PVoC\PVoCApplicationLevel;
use App\Models\Application\TransferredApplication;
use App\Models\Auth\Role;
use App\Models\Auth\Permission;
use App\Models\Auth\User;
use App\Models\Comment\Comment;
use App\Models\Enquiry\EnquiryType;
use App\Models\Premise\PremiseNoneManufacturerInspection;
use App\Models\Staff\Staff;
use App\Models\System\CodeValue;
use App\Models\System\Country;
use App\Models\System\Document;
use App\Models\System\Region;
use App\Models\Member\Company\Company;
use App\Models\Workflow\WfDefinition;
use App\Models\Workflow\WfTrack;


trait UserRelationship
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function userAccounts()
    {
        return $this->belongsToMany(CodeValue::class, "user_accounts", "user_id", "user_account_cv_id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return mixed
     */
    public function wfTracks()
    {
        //return $this->hasMany(WfTrack::class);
        return $this->morphMany(WfTrack::class, 'user','id');
    }

    /**
     * @return mixed
     */
    public function wfTracksUser()
    {
        //return $this->hasMany(WfTrack::class);
        return $this->hasMany(WfTrack::class);
    }

    public function wfDefinition()
    {
        return $this->belongsToMany(WfDefinition::class,'user_wf_definition');
    }



    public function logs()
    {
        return $this->hasMany('user_logs','user_id','id');
    }



}
