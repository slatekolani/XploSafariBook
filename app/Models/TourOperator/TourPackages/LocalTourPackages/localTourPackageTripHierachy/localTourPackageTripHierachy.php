<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageTripHierachy;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\Model;

class localTourPackageTripHierachy extends BaseModel
{
    protected $table='package_trip_hierachies';
    protected $guarded=['uuid'];

    public function localTourPackage()
    {
        return $this->belongsTo(localTourPackages::class);
    }
}
