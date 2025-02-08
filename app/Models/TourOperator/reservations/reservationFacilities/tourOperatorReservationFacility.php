<?php

namespace App\Models\TourOperator\reservations\reservationFacilities;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\reservations\tourOperatorReservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourOperatorReservationFacility extends BaseModel
{
    use SoftDeletes;
    protected $table='reservation_facilities';
    protected $guarded=['uuid'];
    public function tourOperatorReservation()
    {
        return $this->belongsTo(tourOperatorReservation::class);
    }
}
