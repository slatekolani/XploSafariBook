<?php

namespace App\Models\tanzaniaAndWorldEvents;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tanzaniaAndWorldEvents extends BaseModel
{
    use SoftDeletes;
    protected $table='tanzania_and_world_event';
    protected $guarded=['uuid'];

    public function localTourPackages()
    {
        return $this->hasMany(localTourPackages::class);
    }
    public function getEventStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Active</span>';
                break;
        }
    }

    public function getEventButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('event.view',$this->uuid).'" class="btn btn-success btn-sm">View</a>';
        $btn=$btn.'<a href="'.route('event.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('event.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
