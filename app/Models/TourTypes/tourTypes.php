<?php

namespace App\Models\TourTypes;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Models\TourOperatorsBlogs\tourOperatorsBlogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourTypes extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_types';
    protected $guarded=['uuid'];

    public function tourOperatorsBlogs()
    {
        return $this->belongsToMany(tourOperatorsBlogs::class);
    }
    public function customTourBookings()
    {
        return $this->belongsTo(customTourBookings::class);
    }
    public function gettourTypeStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-warning">Unchecked</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Checked</span>';
                break;
            default:
                return '<span class="badge badge-warning">Unchecked</span>';
                break;
        }
    }
    public function getTourTypeButtonActionsLabelAttribute()
    {
        $btn='<a href="'.route('tourType.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('tourType.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
