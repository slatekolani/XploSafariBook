<?php

namespace App\Models\aboutTanzania\tanzaniaVisitAdvice;

use App\Models\BaseModel\BaseModel;
use App\Models\Nations\nations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tanzaniaVisitAdvice extends BaseModel
{
    use SoftDeletes;
    protected $table='tanzania_visit_advice';
    protected $guarded=['uuid'];

    public function nation()
    {
        return $this->belongsTo(nations::class);
    }
    public function getButtonActionsLabelAttribute()
    {
        $btn='<a href="'.route('tanzaniaVisitAdvice.show',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('tanzaniaVisitAdvice.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('tanzaniaVisitAdvice.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
