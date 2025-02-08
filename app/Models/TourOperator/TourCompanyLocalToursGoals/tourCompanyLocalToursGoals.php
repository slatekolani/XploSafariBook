<?php

namespace App\Models\TourOperator\TourCompanyLocalToursGoals;
use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourCompanyLocalToursGoals\packageSegmentation\localTourGoalsPackageSegmentation;
use App\Models\TourOperator\TourCompanyLocalToursGoals\projectedRevenue\localTourGoalsProjectedRevenue;
use App\Models\TourOperator\tourOperator;
use App\Repositories\TourOperator\TourCompanyLocalToursGoals\packageSegmentation\tourCompanyLocalToursGoalsPackageSegmentationRepository;
use App\Repositories\TourOperator\TourCompanyLocalToursGoals\projectedRevenue\localToursGoalsProjectedRevenueRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourCompanyLocalToursGoals extends BaseModel
{
    use SoftDeletes;
    protected $guarded=['uuid'];
    protected $table='tour_company_local_tours_goals';
    protected $dates=['deleted_at'];

    public function localTourGoalsPackageSegmentation()
    {
        return $this->hasMany(localTourGoalsPackageSegmentation::class);
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function localTourGoalsProjectedRevenue()
    {
        return $this->hasMany(localTourGoalsProjectedRevenue::class);
    }
    public function getButtonActionLabelAttribute()
    {
        return "<select name='action' class='action_select'>
        <option value=''>Select</option>
        <option data-route='#' value='2'>Result Overview</option>
        <option data-route='".route('tourCompanyLocalToursGoals.edit',$this->uuid)."' value='2'>Edit</option>
        <option data-route='".route('tourCompanyLocalToursGoals.show',$this->uuid)."' value='2'>View</option>
        <option data-route='#' value='1'>Delete</option>
        <option data-route='#' value='2'>Revenue Breakdown</option>
        <option data-route='#' value='2'>Package Segmentation</option>
    </select>";
    }
    public function saveLocalTourGoalsProjectedRevenue($input,$tourCompanyLocalToursGoal)
    {
        $localTourGoalsProjectedRevenueRepo= new localToursGoalsProjectedRevenueRepository();
        $localTourGoalsProjectedRevenue=$localTourGoalsProjectedRevenueRepo->storeLocalTourGoalsProjectedRevenue($input,$tourCompanyLocalToursGoal);
        return back()->with('localTourGoalsProjectedRevenue',$localTourGoalsProjectedRevenue);
    }
    public function updateLocalTourGoalsProjectedRevenue($input,$tourCompanyLocalToursGoal)
    {
        $localTourGoalsProjectedRevenueRepo= new localToursGoalsProjectedRevenueRepository();
        $localTourGoalsProjectedRevenue=$localTourGoalsProjectedRevenueRepo->updateLocalTourGoalsProjectedRevenue($input,$tourCompanyLocalToursGoal);
        return back()->with('localTourGoalsProjectedRevenue',$localTourGoalsProjectedRevenue);
    }
    public function saveLocalTourGoalsPackageSegmentation($input,$tourCompanyLocalToursGoal)
    {
        $localTourGoalsPackageSegmentationRepo=new tourCompanyLocalToursGoalsPackageSegmentationRepository();
        $localTourGoalsPackage=$localTourGoalsPackageSegmentationRepo->storeLocalTourGoalPackageSegmentation($input,$tourCompanyLocalToursGoal);
        return back()->with('localTourGoalsPackage',$localTourGoalsPackage);
    }
    public function updateLocalTourGoalsPackageSegmentation($input,$tourCompanyLocalToursGoal)
    {
        $localTourGoalsPackageSegmentationRepo=new tourCompanyLocalToursGoalsPackageSegmentationRepository();
        $localTourGoalsPackage=$localTourGoalsPackageSegmentationRepo->updateLocalTourGoalsPackageSegmentation($input,$tourCompanyLocalToursGoal);
        return back()->with('localTourGoalsPackage',$localTourGoalsPackage);
    }
}
