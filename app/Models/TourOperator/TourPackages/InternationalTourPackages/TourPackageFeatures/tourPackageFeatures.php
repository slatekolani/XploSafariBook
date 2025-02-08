<?php

namespace App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageFeatures;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourPackageFeatures extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_package_features';
    protected $guarded=['uuid'];

    public function TourPackages()
    {
        return $this->belongsTo(TourPackages::class);
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
}
