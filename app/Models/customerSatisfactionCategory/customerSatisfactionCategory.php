<?php

namespace App\Models\customerSatisfactionCategory;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;

class customerSatisfactionCategory extends BaseModel
{
    use SoftDeletes;
    protected $table='customer_satisfaction_category';
    protected $guarded=['uuid'];

    public function localTourPackages()
    {
        return $this->belongsToMany(localTourPackages::class);
    }
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('customerSatisfactionCategory.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('customerSatisfactionCategory.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('customerSatisfactionCategory.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
