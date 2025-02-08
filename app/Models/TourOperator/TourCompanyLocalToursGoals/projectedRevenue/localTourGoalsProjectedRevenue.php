<?php

namespace App\Models\TourOperator\TourCompanyLocalToursGoals\projectedRevenue;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Models\TourOperator\tourOperator;
use Illuminate\Database\Eloquent\Model;

class localTourGoalsProjectedRevenue extends BaseModel
{
    protected $table='local_tour_goals_projected_revenues';
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
