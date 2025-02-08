<?php

namespace App\Models\TouristicAttractions;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class attractionVisitReasons extends BaseModel
{
    use SoftDeletes;
    protected $table='attraction_visit_reasons';
    protected $guarded=['uuid'];

    public function touristicAttractions()
    {
        return $this->belongsTo(touristicAttractions::class);
    }
}
