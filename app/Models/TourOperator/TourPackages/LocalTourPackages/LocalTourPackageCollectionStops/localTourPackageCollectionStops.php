<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;

class localTourPackageCollectionStops extends BaseModel
{
    use SoftDeletes;
    protected $table='local_tour_package_collection_stop';
    protected $guarded=['uuid'];

    public function localTourPackage()
    {
        return $this->belongsTo(localTourPackages::class);
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function collectionStop()
    {
        return $this->belongsTo(localTourPackageCollectionStops::class,'collection_station');
    }
}
