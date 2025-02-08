<?php

namespace App\Models\TouristicAttractions\touristicAttractionHoneyPoint;

use App\Models\BaseModel\BaseModel;
use App\Models\TouristicAttractions\touristicAttractions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class touristicAttractionHoneyPoints extends BaseModel
{
    use SoftDeletes;
    protected $table='touristic_attraction_honey_point';
    protected $guarded=['uuid'];

    public function touristicAttractions()
    {
        return $this->belongsTo(touristicAttractions::class);
    }
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('touristicAttractionHoneyPoint.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionHoneyPoint.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionHoneyPoint.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
