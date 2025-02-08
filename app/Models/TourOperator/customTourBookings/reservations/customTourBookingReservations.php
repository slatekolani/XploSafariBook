<?php

namespace App\Models\TourOperator\customTourBookings\reservations;

use App\Models\BaseModel\BaseModel;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\reservations\tourOperatorReservation;

class customTourBookingReservations extends BaseModel
{
    protected $table='custom_tour_booking_reservations';
    protected $guarded=['uuid'];

    public function touristicAttraction()
    {
        return $this->belongsTo(touristicAttractions::class,'touristic_attraction_id');
    }
    public function tourOperatorReservation()
    {
        return $this->belongsTo(tourOperatorReservation::class,'tour_operator_reservation_id');
    }
}
