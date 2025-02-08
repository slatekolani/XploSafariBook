<?php

namespace App\Models\specialNeed;

use App\Models\BaseModel\BaseModel;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Models\TourOperatorsBlogs\tourOperatorsBlogs;
use Illuminate\Database\Eloquent\SoftDeletes;

class specialNeed extends BaseModel
{
    use SoftDeletes;
    protected $table='special_needs';
    protected $guarded=['uuid'];

    public function TourPackages()
    {
        return $this->belongsToMany(TourPackages::class);
    }
    public function localTourPackages()
    {
        return $this->belongsToMany(localTourPackages::class);
    }
  
    public function getSpecialNeedStatusLabelAttribute()
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
    public function getSpecialNeedsButtonActionsLabelAttribute()
    {
        $btn='<a href="'.route('specialNeed.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        $btn=$btn.'<a href="'.route('specialNeed.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        return $btn;

    }
}
