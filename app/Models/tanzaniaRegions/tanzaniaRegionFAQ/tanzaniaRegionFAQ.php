<?php

namespace App\Models\tanzaniaRegions\tanzaniaRegionFAQ;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use Illuminate\Database\Eloquent\SoftDeletes;

class tanzaniaRegionFAQ extends BaseModel
{
    use SoftDeletes;
    protected $table='tanzania_region_faq';
    protected $guarded=['uuid'];

    public function tanzaniaRegion()
    {
        return $this->belongsTo(tanzaniaRegions::class);
    }
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('tanzaniaRegionFAQ.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('tanzaniaRegionFAQ.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('tanzaniaRegionFAQ.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
