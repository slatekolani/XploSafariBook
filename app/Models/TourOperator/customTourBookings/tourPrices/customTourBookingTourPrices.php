<?php

namespace App\Models\TourOperator\customTourBookings\tourPrices;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use Illuminate\Database\Eloquent\Model;

class customTourBookingTourPrices extends BaseModel
{
    protected $guarded=['uuid'];
    protected $table='custom_tour_booking_tour_prices';

    public function customTourBookings()
    {
        return $this->belongsTo(customTourBookings::class);
    }
}
