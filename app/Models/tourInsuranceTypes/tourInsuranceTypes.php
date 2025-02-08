<?php

namespace App\Models\tourInsuranceTypes;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourInsuranceTypes extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_insurance_type';
    protected $guarded=['uuid'];

    public function getTourInsuranceStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger badge-pill">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success badge-pill">Active</span>';
                break;
        }
    }

    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('tourInsuranceType.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('tourInsuranceType.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('tourInsuranceType.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
