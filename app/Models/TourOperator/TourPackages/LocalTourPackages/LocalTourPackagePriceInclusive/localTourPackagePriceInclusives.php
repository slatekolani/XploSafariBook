<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackagePriceInclusive;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;

class localTourPackagePriceInclusives extends BaseModel
{
    use SoftDeletes;
    protected $table='local_tour_package_price_inclusive';
    protected $guarded=['uuid'];

    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function localTourPackages()
    {
        return $this->belongsTo(localTourPackages::class);
    }
}
