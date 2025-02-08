<?php

namespace App\Models\Nations;

use App\Models\aboutTanzania\FAQ\tanzaniaFAQ;
use App\Models\aboutTanzania\tanzaniaVisitAdvice\tanzaniaVisitAdvice;
use App\Models\BaseModel\BaseModel;
use App\Models\Nations\economicActivity\nationEconomicActivity;
use App\Models\Nations\Precaution\nationPrecautions;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use App\Models\TouristicAttractions\touristicAttractionRules\touristicAttractionRules;
use App\Models\TourOperator\tourOperator;
use App\Repositories\Admin\Nations\economicActivity\nationEconomicActivityRepository;
use App\Repositories\Admin\Nations\precaution\nationPrecautionRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nations extends BaseModel
{
    use SoftDeletes;
    protected $table='nation';
    protected $guarded=['uuid'];

    public function getNationFlagLabelAttribute()
    {
        return url('public/nationFlags/',$this->nation_flag);
    }
    public function tanzaniaRegions()
    {
        return $this->hasMany(tanzaniaRegions::class);
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function touristicAttractionRules()
    {
        return $this->hasMany(touristicAttractionRules::class);
    }
    public function tanzaniaVisitAdvice()
    {
        return $this->hasMany(tanzaniaVisitAdvice::class);
    }

    public function tanzaniaFAQ()
    {
        return $this->hasMany(tanzaniaFAQ::class,'nation_id');
    }
    public function nationEconomicActivity()
    {
        return $this->hasMany(nationEconomicActivity::class);
    }

    public function nationPrecautions()
    {
        return $this->hasMany(nationPrecautions::class);
    }

    public function getNationStatusLabelAttribute()
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
        }
    }
    public function getButtonActionsLabelAttribute()
    {
        $btn='<a href="'.route('nation.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        $btn=$btn.'<a href="'.route('nation.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('tanzaniaFAQ.index',$this->uuid).'" class="btn btn-primary btn-sm">FAQ</a>';
        $btn=$btn.'<a href="'.route('tanzaniaVisitAdvice.index',$this->uuid).'" class="btn btn-primary btn-sm">Visit advices</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionRule.index',$this->uuid).'" class="btn btn-primary btn-sm">Attraction rules</a>';
        return $btn;
    }
    public function saveNationEconomicActivities($input,$nation)
    {
        $nationEconomicActivitiesRepo=new nationEconomicActivityRepository();
        $nationEconomicActivities=$nationEconomicActivitiesRepo->saveNationEconomicActivities($input,$nation);
        return back()->with('nationEconomicActivities',$nationEconomicActivities);
    }
    public function updateNationEconomicActivities($input,$nation)
    {
        $nationEconomicActivitiesRepo=new nationEconomicActivityRepository();
        $nationEconomicActivities=$nationEconomicActivitiesRepo->updateNationEconomicActivities($input,$nation);
        return back()->with('nationEconomicActivities',$nationEconomicActivities);
    }
    public function saveNationPrecautions($input,$nation)
    {
        $nationPrecautionsRepo=new nationPrecautionRepository();
        $nationPrecautions=$nationPrecautionsRepo->saveNationPrecautions($input,$nation);
        return back()->with('nationPrecautions',$nationPrecautions);
    }
    public function updateNationPrecautions($input,$nation)
    {
        $nationPrecautionsRepo=new nationPrecautionRepository();
        $nationPrecautions=$nationPrecautionsRepo->updateNationPrecautions($input,$nation);
        return back()->with('nationPrecautions',$nationPrecautions);
    }
}
