<?php

namespace App\Models\touristicActivities\touristicActivityConductTips;

use App\Models\BaseModel\BaseModel;
use App\Models\touristicActivities\touristicActivities;
use Illuminate\Database\Eloquent\Model;

class touristicActivityConductTips extends BaseModel
{
    protected $table='touristic_activity_conduct_tips';
    protected $guarded=['uuid'];

    public function touristicActivities()
    {
        return $this->belongsTo(touristicActivities::class);
    }
}
