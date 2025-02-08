<?php

namespace App\Models\TourOperator\TourCompanyLocalToursGoals\packageSegmentation;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Models\TourOperator\tourOperator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class localTourGoalsPackageSegmentation extends BaseModel
{
    use SoftDeletes;
    protected $table='local_tour_goals_package_segmentations';
    protected $guarded=['uuid'];
    protected $dates=['deleted_at'];
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function tourCompanyLocalToursGoals()
    {
        return $this->belongsTo(tourCompanyLocalToursGoals::class);
    }
}
