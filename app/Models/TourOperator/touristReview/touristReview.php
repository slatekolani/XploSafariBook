<?php

namespace App\Models\TourOperator\touristReview;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class touristReview extends BaseModel
{
    use SoftDeletes;

    protected $table='tourist_reviews';
    protected $guarded=['uuid'];

    public function tourPackageBookings()
    {
        return $this->belongsTo(tourPackageBookings::class);
    }
    public function getReviewStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-info">Un Approved</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Approved + public</span>';
                break;
            default:
                return '<span class="badge badge-info">Un Approved</span>';
                break;
        }
    }
    public function getTouristReviewButtonActionsLabelAttribute()
    {
        if(Auth::user()->role==1)
        {
            $btn='<a href="'.route('touristReview.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
            $btn=$btn.'<a href="'.route('touristReview.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
            return $btn;
        }
        else{
            $btn = '<btn onclick="alert(\'Admin Use Only!\')" class="btn btn-danger btn-sm">Delete</btn>';
            $btn=$btn.'<a href="'.route('touristReview.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
            return $btn;
        }
    }
    public function getDeletedTouristReviewButtonActionsLabelAttribute()
    {
        if (Auth::user()->role==1)
        {
            $btn='<a href="'.route('touristReview.restoreDeletedTouristReviews',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
            return $btn;
        }
        else
        {
            $btn='<btn onclick="alert(\'Admin use only\')" class="btn btn-warning btn-sm">Restore</btn>';
            return $btn;
        }
    }
}
