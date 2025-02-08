<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourpackagePriceExclusive;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class localTourPackagePriceExclusive extends BaseModel
{
    use SoftDeletes;
    protected $table='local_package_price_exclusives';
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
