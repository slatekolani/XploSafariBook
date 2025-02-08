<?php

namespace App\Models\Transport;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use App\Models\TourOperatorsBlogs\tourOperatorsBlogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transport extends BaseModel
{
    use SoftDeletes;
    protected $table='transports';
    protected $guarded=['uuid'];

    public function TourPackages()
    {
        return $this->belongsToMany(TourPackages::class);
    }
    public function localTourPackages()
    {
        return $this->belongsToMany(localTourPackages::class);
    }
    public function getTransportStatusLabelAttribute()
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
        }
    }
    public function getTransportButtonActionsLabelAttribute()
    {
        $btn='<a href="'.route('transport.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('transport.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
}
