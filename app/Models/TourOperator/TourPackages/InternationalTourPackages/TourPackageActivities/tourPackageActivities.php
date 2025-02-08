<?php

namespace App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageActivities;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourPackageActivities extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_package_activities';
    protected $guarded=['uuid'];

    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function TourPackages()
    {
        return $this->belongsTo(TourPackages::class);
    }
}
