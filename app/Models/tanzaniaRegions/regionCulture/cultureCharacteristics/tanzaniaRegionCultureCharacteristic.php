<?php

namespace App\Models\tanzaniaRegions\regionCulture\cultureCharacteristics;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use Illuminate\Database\Eloquent\Model;

class tanzaniaRegionCultureCharacteristic extends BaseModel
{
    protected $table='culture_characteristics';
    protected $guarded=['uuid'];

    public function tanzaniaRegionCulture()
    {
        return $this->belongsTo(tanzaniaRegionCulture::class);
    }
}
