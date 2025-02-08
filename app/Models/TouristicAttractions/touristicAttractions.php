<?php

namespace App\Models\TouristicAttractions;

use App\Models\BaseModel\BaseModel;
use App\Models\specialNeed\specialNeed;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\touristicActivities\touristicActivities;
use App\Models\TouristicAttractions\category\touristicAttractionCategory;
use App\Models\TouristicAttractions\FAQ\frequentAskedQuestions;
use App\Models\TouristicAttractions\touristicAttractionHoneyPoint\touristicAttractionHoneyPoints;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Months;
use App\Repositories\Admin\TouristicAttraction\attractionVisitReasonsRepository;
use App\Repositories\Admin\TouristicAttraction\touristicAttractionVisitAdvicesRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class touristicAttractions extends BaseModel
{
    use SoftDeletes;
    protected $table='touristic_attraction';
    protected $guarded=['uuid'];

    public function touristicAttractionActivities()
    {
        return $this->belongsToMany(touristicActivities::class,'touristic_attraction_activities','touristic_attraction_id','touristic_activities_id');
    }
    public function tanzaniaRegion()
    {
        return $this->belongsTo(tanzaniaRegions::class,'attraction_region');
    }
    public function touristicAttractionCategory()
    {
        return $this->belongsTo(touristicAttractionCategory::class,'attraction_category');
    }
    public function touristAttractionFaq()
    {
        return $this->hasMany(touristAttractionFaq::class);
    }

    public function localTourPackages()
    {
        return $this->hasMany(localTourPackages::class);
    }
    public function touristicAttractionHoneyPoints()
    {
        return $this->hasMany(touristicAttractionHoneyPoints::class);
    }

    public function touristicAttractionVisitAdvices()
    {
        return $this->hasMany(touristicAttractionVisitAdvices::class);
    }
    public function attractionVisitReasons()
    {
        return $this->hasMany(attractionVisitReasons::class);
    }
    public function getAttractionStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-warning">Unchecked</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Checked</span>';
                break;
            default:
                return '<span class="badge badge-danger">Unidentified</span>';
                break;
        }
    }
    public function getTouristicAttractionActivities(array $input, Model $touristicAttraction)
    {
        $touristicAttractionActivitiesArray=[];
        foreach($input as $key =>$value)
        {
            switch($key)
            {
                case 'activities_in_attraction':
                    $touristicAttractionActivitiesArray=$value;
                    break;
            }
        }
        $touristicAttraction->touristicAttractionActivities()->sync($touristicAttractionActivitiesArray);
    }
    
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('touristicAttraction.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        $btn=$btn.'<a href="'.route('touristicAttraction.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionHoneyPoint.index',$this->uuid).'" class="btn btn-warning btn-sm">Honey points</a>';
        $btn=$btn.'<a href="'.route('touristicAttraction.touristAttractionFAQIndex',$this->uuid).'" class="btn btn-success btn-sm">FAQs</a>';
        return $btn;
    }
    public function saveTouristicAttractionVisitAdvices($input, $touristicAttraction)
    {
        $touristicAttractionVisitAdvicesRepo=new touristicAttractionVisitAdvicesRepository();
        $touristicAttractionVisitAdvices=$touristicAttractionVisitAdvicesRepo->storeTouristicAttractionVisitAdvices($input,$touristicAttraction);
        return redirect()->back()->with('touristicAttractionVisitAdvices',$touristicAttractionVisitAdvices);
    }
    public function updateTouristicAttractionVisitAdvices($input,$touristicAttraction)
    {
        $touristicAttractionVisitAdvicesRepo=new touristicAttractionVisitAdvicesRepository();
        $touristicAttractionVisitAdvices=$touristicAttractionVisitAdvicesRepo->updateTouristicAttractionVisitAdvices($input,$touristicAttraction);
        return redirect()->back()->with('touristicAttractionVisitAdvices',$touristicAttractionVisitAdvices);
    }
    public function saveTouristicAttractionVisitReasons($input, $touristicAttraction)
    {
        $touristicAttractionVisitReasonsRepo=new attractionVisitReasonsRepository();
        $touristicAttractionVisitReasons=$touristicAttractionVisitReasonsRepo->storeTouristicAttractionVisitReasons($input,$touristicAttraction);
        return redirect()->back()->with('touristicAttractionVisitReasons',$touristicAttractionVisitReasons);
    }
    public function updateTouristicAttractionVisitReasons($input,$touristicAttraction)
    {
        $touristicAttractionVisitReasonsRepo=new attractionVisitReasonsRepository();
        $touristicAttractionVisitReasons=$touristicAttractionVisitReasonsRepo->updateTouristicAttractionVisitReasons($input,$touristicAttraction);
        return redirect()->back()->with('touristicAttractionVisitReasons',$touristicAttractionVisitReasons);
    }
   
}
