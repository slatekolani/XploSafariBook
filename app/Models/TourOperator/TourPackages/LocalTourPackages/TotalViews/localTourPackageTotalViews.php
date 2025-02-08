<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\TotalViews;

use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\Model;

class localTourPackageTotalViews extends Model
{
    protected $guarded=[];
    protected $table='local_tour_package_total_views';

    public function localTourPackage()
    {
        return $this->belongsTo(localTourPackages::class);
    }
}
