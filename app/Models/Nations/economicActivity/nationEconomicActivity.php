<?php

namespace App\Models\Nations\economicActivity;

use App\Models\BaseModel\BaseModel;
use App\Models\Nations\nations;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nationEconomicActivity extends BaseModel
{
    use SoftDeletes;
    protected $table='nation_economic_activities';
    protected $guarded=['uuid'];
    public function nation()
    {
        return $this->belongsTo(nations::class);
    }
    public function tanzaniaRegions()
    {
        return $this->belongsToMany(tanzaniaRegions::class,'tanzania_region_nation_economic_activity','tanzania_region_id','nation_economic_activity_id');
    }
    public function tanzaniaRegion()
    {
        return $this->belongsTo(tanzaniaRegions::class);
    }
}
