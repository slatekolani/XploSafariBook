<?php

namespace App\Models\tanzaniaRegions;

use App\Models\BaseModel\BaseModel;
use App\Models\Nations\economicActivity\nationEconomicActivity;
use App\Models\Nations\nations;
use App\Models\tanzaniaRegions\Precautions\tanzaniaRegionPrecautions;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use App\Models\tanzaniaRegions\tanzaniaRegionFAQ\tanzaniaRegionFAQ;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Repositories\tanzaniaRegions\precautions\tanzaniaRegionPrecautionRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class tanzaniaRegions extends BaseModel
{
    use SoftDeletes;
    protected $table='tanzania_region';
    protected $guarded=['uuid'];

    public function customTourBooking()
    {
       return $this->belongsTo(customTourBookings::class);
    }
    public function Nation()
    {
        return $this->belongsTo(nations::class);
    }
    public function tourOperatorReservation()
    {
        return $this->hasMany(tourOperatorReservation::class);
    }
    public function touristicAttractions()
    {
        return $this->hasMany(touristicAttractions::class);
    }
    public function tanzaniaRegionPrecautions()
    {
        return $this->hasMany(tanzaniaRegionPrecautions::class);
    }
    public function tanzaniaRegionFAQ()
    {
        return $this->hasMany(tanzaniaRegionFAQ::class);
    }
    public function tanzaniaRegionCulture()
    {
        return $this->hasMany(tanzaniaRegionCulture::class);
    }
    public function regionEconomicActivity()
    {
        return $this->belongsTo(nationEconomicActivity::class,'economic_activity');
    }
    public function nationEconomicActivity()
    {
        return $this->belongsToMany(nationEconomicActivity::class,'region_economic_activity','tanzania_region_id','nation_economic_activity_id');
    }

    public function getTanzaniaRegionStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger badge-pill">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success badge-pill">Active</span>';
                break;
        }
    }
    public function getTanzaniaRegionButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('tanzaniaRegion.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('tanzaniaRegion.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('regionCulture.index',$this->uuid).'" class="btn btn-primary btn-sm">Cultures</a>';
        $btn=$btn.'<a href="'.route('tanzaniaRegionFAQ.index',$this->uuid).'" class="btn btn-primary btn-sm">FAQ</a>';
        $btn=$btn.'<a href="'.route('tanzaniaRegion.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
    public function saveTanzaniaRegionPrecautions($input,$tanzaniaRegion)
    {
        $tanzaniaRegionPrecautionsRepo=new tanzaniaRegionPrecautionRepository();
        $tanzaniaRegionPrecautions=$tanzaniaRegionPrecautionsRepo->saveTanzaniaRegionPrecautions($input,$tanzaniaRegion);
        return back()->with('tanzaniaRegionPrecautions',$tanzaniaRegionPrecautions);
    }
    public function updateTanzaniaRegionPrecautions($input,$tanzaniaRegion)
    {
        $tanzaniaRegionPrecautionsRepo=new tanzaniaRegionPrecautionRepository();
        $tanzaniaRegionPrecautions=$tanzaniaRegionPrecautionsRepo->updateTanzaniaRegionPrecautions($input,$tanzaniaRegion);
        return back()->with('tanzaniaRegionPrecautions',$tanzaniaRegionPrecautions);
    }
    public function getRegionEconomicActivities(array $input, Model $tanzaniaRegion)
    {
        $regionEconomicActivityArray=[];
        foreach($input as $key =>$value)
        {
            switch ($key)
            {
                case 'other_economic_activities':
                    $regionEconomicActivityArray=$value;
                    break;
            }
        }
        $tanzaniaRegion->nationEconomicActivity()->sync($regionEconomicActivityArray);
    }

    public function getRegionEconomicActivitiesLabelAttribute()
    {
        $regionEconomicActivitiesId = DB::table('region_economic_activity')->where('tanzania_region_id', $this->id)->pluck('nation_economic_activity_id');
        $regionEconomicActivities = nationEconomicActivity::whereIn('id', $regionEconomicActivitiesId)->get();
        $economicActivities = [];

        foreach ($regionEconomicActivities as $regionEconomicActivity) {
            $economicActivities[] = [
                'title' => $regionEconomicActivity->economic_activity_title,
                'description' => $regionEconomicActivity->economic_activity_description,
            ];
        }

        return $economicActivities;
    }

}
