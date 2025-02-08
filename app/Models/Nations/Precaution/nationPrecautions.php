<?php

namespace App\Models\Nations\Precaution;

use App\Models\BaseModel\BaseModel;
use App\Models\Nations\nations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nationPrecautions extends BaseModel
{
    use SoftDeletes;
    protected $table='nation_precautions';
    protected $guarded=['uuid'];

    public function nation()
    {
        return $this->belongsTo(nations::class);
    }
}
