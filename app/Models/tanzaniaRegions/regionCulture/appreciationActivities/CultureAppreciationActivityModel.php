<?php

namespace App\Models\tanzaniaRegions\regionCulture\appreciationActivities;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use Illuminate\Database\Eloquent\Model;

class CultureAppreciationActivityModel extends BaseModel
{
    protected $table='appreciation_activities';
    protected $guarded=['uuid'];

    public function tanzaniaRegionCulture()
    {
        return $this->belongsTo(tanzaniaRegionCulture::class);
    }
}
