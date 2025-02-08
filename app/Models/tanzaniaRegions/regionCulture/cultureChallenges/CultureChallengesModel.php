<?php

namespace App\Models\tanzaniaRegions\regionCulture\cultureChallenges;

use App\Models\BaseModel\BaseModel;
use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use Illuminate\Database\Eloquent\Model;

class CultureChallengesModel extends BaseModel
{
    protected $table='culture_challenges';
    protected $guarded=['uuid'];

    public function tanzaniaRegionCulture()
    {
        return $this->belongsTo(tanzaniaRegionCulture::class);
    }
}
