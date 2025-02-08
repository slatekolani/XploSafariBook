<?php

namespace App\Models\TouristicAttractions\touristicAttractionRules;

use App\Models\BaseModel\BaseModel;
use App\Models\Nations\nations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class touristicAttractionRules extends BaseModel
{
    use SoftDeletes;
    protected $table='touristic_attraction_rules';
    protected $guarded=['uuid'];

    public function nation()
    {
        return $this->belongsTo(nations::class);
    }
    public function getButtonActionRuleLabelAttribute()
    {
        $btn='<a href="'.route('touristicAttractionRule.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionRule.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('touristicAttractionRule.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
