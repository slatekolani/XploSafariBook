<?php

namespace App\Models\tanzaniaRegions\Precautions;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tanzaniaRegionPrecautions extends BaseModel
{
    use SoftDeletes;
    protected $table='tanzania_region_precaution';
    protected $guarded=['uuid'];

    public function tanzaniaRegion()
    {
        return $this->belongsTo(tanzaniaRegions::class);
    }
}
