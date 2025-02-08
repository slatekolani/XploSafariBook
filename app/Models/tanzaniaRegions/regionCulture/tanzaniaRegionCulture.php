<?php

namespace App\Models\tanzaniaRegions\regionCulture;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\regionCulture\appreciationActivities\CultureAppreciationActivityModel;
use App\Models\tanzaniaRegions\regionCulture\cultureChallenges\CultureChallengesModel;
use App\Models\tanzaniaRegions\regionCulture\cultureCharacteristics\tanzaniaRegionCultureCharacteristic;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Repositories\tanzaniaRegions\regionCulture\cultureCharacteristics\tanzaniaRegionCultureCharacteristicRepository;
use Illuminate\Database\Eloquent\Model;

class tanzaniaRegionCulture extends BaseModel
{
    protected $table='tanzania_region_culture';
    protected $guarded=['uuid'];

    public function CultureChallengesModel()
    {
        return $this->hasMany(CultureChallengesModel::class);
    }

    public function CultureAppreciationActivityModel()
    {
        return $this->hasMany(CultureAppreciationActivityModel::class);
    }
    public function tanzaniaRegion()
    {
        return $this->belongsTo(tanzaniaRegions::class);
    }
    public function tanzaniaRegionCultureCharacteristic()
    {
        return $this->hasMany(tanzaniaRegionCultureCharacteristic::class);
    }

    public function saveTanzaniaRegionCultureCharacteristics($input,$tanzaniaRegionCulture)
    {
        $tanzaniaRegionCultureCharacteristicsRepo=new tanzaniaRegionCultureCharacteristicRepository();
        $tanzaniaRegionCultureCharacteristics=$tanzaniaRegionCultureCharacteristicsRepo->saveTanzaniaRegionCultureCharacteristics($input,$tanzaniaRegionCulture);
        return back()->with('tanzaniaRegionCultureCharacteristics',$tanzaniaRegionCultureCharacteristics);
    }
    public function saveCultureAppreciationActivities($input,$tanzaniaRegionCulture)
    {
        $cultureAppreciationActivitiesRepo=new tanzaniaRegionCultureCharacteristicRepository();
        $cultureAppreciationActivities=$cultureAppreciationActivitiesRepo->saveCultureAppreciationActivities($input,$tanzaniaRegionCulture);
        return back()->with('cultureAppreciationActivities',$cultureAppreciationActivities);
    }
    public function saveCultureChallenges($input,$tanzaniaRegionCulture)
    {
        $challengeCultureRepo=new tanzaniaRegionCultureCharacteristicRepository();
        $challengeCulture=$challengeCultureRepo->saveCultureChallenges($input,$tanzaniaRegionCulture);
        return back()->with('challengeCulture',$challengeCulture);
    }
    public function updateTanzaniaRegionCultureCharacteristics($input,$tanzaniaRegionCulture)
    {
        $tanzaniaRegionCultureCharacteristicsRepo=new tanzaniaRegionCultureCharacteristicRepository();
        $tanzaniaRegionCultureCharacteristics=$tanzaniaRegionCultureCharacteristicsRepo->updateTanzaniaRegionCultureCharacteristic($input,$tanzaniaRegionCulture);
        return back()->with('tanzaniaRegionCultureCharacteristics',$tanzaniaRegionCultureCharacteristics);
    }
    public function updateCultureAppreciationActivities($input,$tanzaniaRegionCulture)
    {
        $cultureAppreciationActivitiesRepo=new tanzaniaRegionCultureCharacteristicRepository();
        $cultureAppreciationActivities=$cultureAppreciationActivitiesRepo->updateCultureAppreciationActivities($input,$tanzaniaRegionCulture);
        return back()->with('cultureAppreciationActivities',$cultureAppreciationActivities);
    }
    public function updateCultureChallenges($input,$tanzaniaRegionCulture)
    {
        $cultureChallengesRepo=new tanzaniaRegionCultureCharacteristicRepository();
        $cultureChallenges=$cultureChallengesRepo->updateCultureChallenges($input,$tanzaniaRegionCulture);
        return back()->with('cultureChallenges',$cultureChallenges);
    }
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('regionCulture.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('regionCulture.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('regionCulture.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
