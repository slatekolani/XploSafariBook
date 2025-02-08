<?php

namespace App\Models\tourPackageType;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourPackageType extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_package_types';
    protected $guarded=['uuid'];

    public function localTourPackages()
    {
        return $this->hasMany(localTourPackages::class);
    }
    public function getTourPackageTypeStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Active</span>';
                break;
        }
    }
    public function getTourPackageTypeButtonActionsAttribute()
    {
        $btn='<a href="'.route('tourPackageType.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('tourPackageType.edit',$this->uuid).'" class="btn btn-success btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('tourPackageType.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
