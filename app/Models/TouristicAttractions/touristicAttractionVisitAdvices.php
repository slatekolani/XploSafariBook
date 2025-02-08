<?php

namespace App\Models\TouristicAttractions;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class touristicAttractionVisitAdvices extends BaseModel
{
    use SoftDeletes;
    protected $table='attraction_visit_advices';
    protected $guarded=['uuid'];

    public function touristicAttractions()
    {
        return $this->belongsTo(touristicAttractions::class);
    }
}
