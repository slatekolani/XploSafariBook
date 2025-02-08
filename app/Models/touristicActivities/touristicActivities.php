<?php

namespace App\Models\touristicActivities;

use App\Models\BaseModel\BaseModel;
use App\Models\touristicActivities\touristicActivityConductTips\touristicActivityConductTips;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Repositories\touristicActivities\touristicActivitiesTips\touristicActivitiesConductTipsRepository;
use Illuminate\Database\Eloquent\Model;

class touristicActivities extends BaseModel
{
    protected $table = 'touristic_activities';
    protected $guarded = ['uuid'];


    public function touristicActivityConductTips()
    {
        return $this->hasMany(touristicActivityConductTips::class);
    }

    
    public function getButtonActionsLabelAttribute()
    {
        $btn = '<a href="' . route('touristicActivity.show', $this->uuid) . '" class="btn btn-success btn-sm">View</a>';
        $btn = $btn . '<a href="' . route('touristicActivity.edit', $this->uuid) . '" class="btn btn-primary btn-sm">Edit</a>';
        $btn = $btn . '<a href="' . route('touristicActivity.delete', $this->uuid) . '" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }

    public function saveTouristicActivityConductTips($input, $touristicActivity)
    {
        $touristicActivityConductTipsRepo = new touristicActivitiesConductTipsRepository();
        $touristicActivityConductTip = $touristicActivityConductTipsRepo->saveTouristicActivityConductTips($input, $touristicActivity);
        return back()->with('touristicActivityConductTip', $touristicActivityConductTip);
    }
    public function updateTouristicActivityConductTips($input, $touristicActivity)
    {
        $touristicActivityConductTipsRepo = new touristicActivitiesConductTipsRepository();
        $touristicActivityConductTip = $touristicActivityConductTipsRepo->updateTouristicActivityConductTips($input, $touristicActivity);
        return back()->with('touristicActivityConductTip', $touristicActivityConductTip);
    }
}
