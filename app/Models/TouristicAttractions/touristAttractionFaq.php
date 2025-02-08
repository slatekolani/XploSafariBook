<?php

namespace App\Models\TouristicAttractions;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class touristAttractionFaq extends BaseModel
{
    use SoftDeletes;
    protected $table='tourist_attraction_faq';
    protected $guarded=['uuid'];

    public function touristicAttractions()
    {
        return $this->belongsTo(touristicAttractions::class);
    }
    public function getButtonActionLabelAttribute()
    {
       $btn='<a href="'.route('touristicAttraction.editTouristAttractionFAQ',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
       $btn=$btn.'<a href="'.route('touristicAttraction.deleteTouristAttractionFAQ',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
       return $btn;
    }
    public function getQuestionStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-info">Disabled</span>';
                break;
            case 1:
                return '<span class="badge badge-primary">Enabled</span>';
                break;
            default:
                return '<span class="badge badge-info">Disabled</span>';
                break;
        }
    }
}
