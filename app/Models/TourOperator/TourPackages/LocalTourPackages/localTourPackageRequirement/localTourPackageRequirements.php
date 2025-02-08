<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageRequirement;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class localTourPackageRequirements extends BaseModel
{
    use SoftDeletes;
    protected $table='local_tour_package_requirement';
    protected $guarded=['uuid'];

    public function localTourPackages()
    {
        return $this->belongsTo(localTourPackages::class);
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
}
