<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTouristReviews;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class localTouristReviews extends BaseModel
{
    use SoftDeletes;
    protected $table='local_tourist_review';
    protected $guarded=['uuid'];

    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function localTourPackage()
    {
        return $this->belongsTo(localTourPackages::class);
    }
    public function localTourPackageBooking()
    {
        return $this->belongsTo(localTourPackageBookings::class,'local_tour_booking_id');
    }

    public function getReviewStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-danger badge-pill">Unapproved</span>';
                break;
            case 1:
                return '<span class="badge badge-success badge-pill">Approved</span>';
                break;
        }
    }
    public function getButtonActionLabelAttribute()
    {
        if(Auth::user()->role==1)
        {
            $btn='<a href="'.route('localTouristReview.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
            $btn=$btn.'<a href="'.route('localTouristReview.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
            return $btn;
        }
        else{
            $btn = '<btn onclick="alert(\'Admin Use Only!\')" class="btn btn-danger btn-sm">Delete</btn>';
            $btn=$btn.'<a href="'.route('localTouristReview.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
            return $btn;
        }
    }
    public function getDeletedTouristReviewButtonActionsLabelAttribute()
    {
        if (Auth::user()->role==1)
        {
            $btn='<a href="'.route('localTouristReview.showDeletedTouristReview',$this->uuid).'" class="btn btn-warning btn-sm">View</a>';
            $btn=$btn.'<a href="'.route('localTouristReview.restoreDeletedTouristReviews',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
            $btn=$btn.'<a href="'.route('localTouristReview.deletePermanentlyTouristReview',$this->uuid).'" class="btn btn-danger btn-sm">Delete permanently</a>';
            return $btn;
        }
        else
        {
            $btn='<a href="'.route('localTouristReview.showDeletedTouristReview',$this->uuid).'" class="btn btn-warning btn-sm">View</a>';
            $btn=$btn.'<btn onclick="alert(\'Admin use only\')" class="btn btn-warning btn-sm">Restore</btn>';
            $btn=$btn.'<btn onclick="alert(\'Admin use only\')" class="btn btn-danger btn-sm">Delete permanently</btn>';
            return $btn;
        }
    }

}
