<?php

namespace App\Repositories\customTourPackages\TourPrices;

use App\Models\TourOperator\customTourBookings\reservations\customTourBookingReservations;
use App\Models\TourOperator\customTourBookings\tourPrices\customTourBookingTourPrices;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class customTourBookingTourPricesRepository.
 */
class customTourBookingTourPricesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return customTourBookingTourPrices::class;
    }
    public function saveCustomTourBookingTourPrices($input, $customTourBooking)
    {
        foreach ($input['attraction_id'] as $index => $attractionId)
        {
            $customTourBookingTourPrice = customTourBookingTourPrices::query()
                ->where('attraction_id', $attractionId)
                ->where('custom_tour_booking_id', $customTourBooking->id)
                ->first();

            if ($customTourBookingTourPrice) {
                // Update existing prices
                $customTourBookingTourPrice->resident_adult_price = $input['resident_adult_price'][$index];
                $customTourBookingTourPrice->foreigner_adult_price = $input['foreigner_adult_price'][$index];
                $customTourBookingTourPrice->resident_child_price = $input['resident_child_price'][$index];
                $customTourBookingTourPrice->foreigner_child_price = $input['foreigner_child_price'][$index];
                $customTourBookingTourPrice->save();
            } else {
                // Create new price entry
                $customTourBookingTourPrice = new customTourBookingTourPrices();
                $customTourBookingTourPrice->attraction_id = $attractionId;
                $customTourBookingTourPrice->resident_adult_price = $input['resident_adult_price'][$index];
                $customTourBookingTourPrice->foreigner_adult_price = $input['foreigner_adult_price'][$index];
                $customTourBookingTourPrice->resident_child_price = $input['resident_child_price'][$index];
                $customTourBookingTourPrice->foreigner_child_price = $input['foreigner_child_price'][$index];
                $customTourBookingTourPrice->custom_tour_booking_id = $customTourBooking->id;
                $customTourBookingTourPrice->save();
            }
        }
    }
}
