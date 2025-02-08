<?php

namespace App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTripCancellation;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class localTourPackageCancelledbookings extends BaseModel
{
    use SoftDeletes;
    protected $guarded=['uuid'];
    protected $table='local_tour_cancelledbookings' ;
    protected $dates=['deleted_at'];

    public function localTourPackageBookings()
    {
        return $this->hasOne(localTourPackageBookings::class,'id','local_tour_booking_id');
    }
    public function getLocalBookingCancelRequestButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('localTripCancellation.show',$this->uuid).'" class="btn btn-success btn-sm">Show</a>';
        $btn=$btn.'<a href="'.route('localTripCancellation.edit',$this->uuid).'" class="btn btn-primary btn-sm">Edit</a>';
        $btn=$btn.'<a href="'.route('localTripCancellation.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    }
    public function getDeletedLocalBookingCancelRequestButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('localTripCancellation.showDeletedCancellatioRequest',$this->uuid).'" class="btn btn-success btn-sm">Show</a>';
        $btn=$btn.'<a href="'.route('localTripCancellation.restore',$this->uuid).'" class="btn btn-primary btn-sm">Restore</a>';
        $btn=$btn.'<a href="'.route('localTripCancellation.deletePermanently',$this->uuid).'" class="btn btn-danger btn-sm">Delete Permanently</a>';
        return $btn;
    }
}
