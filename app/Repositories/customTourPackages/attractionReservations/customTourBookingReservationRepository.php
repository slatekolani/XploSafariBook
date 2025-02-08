<?php

namespace App\Repositories\customTourPackages\attractionReservations;

use App\Models\TourOperator\customTourBookings\reservations\customTourBookingReservations;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class customTourBookingReservationRepository.
 */
class customTourBookingReservationRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return customTourBookingReservations::class;
    }
    public function saveCustomTourBookingReservations($input, $customTourBooking)
    {
        foreach ($input['touristic_attraction_id'] as $key => $attractionId) {
            $reservationId = $input['tour_operator_reservation_id'][$key] ?? 0;

            $existingReservation = customTourBookingReservations::where('touristic_attraction_id', $attractionId)
                ->where('custom_tour_booking_id',$customTourBooking->id)
                ->first();

            if ($existingReservation) {
                if ($existingReservation->tour_operator_reservation_id != $reservationId) {
                    $existingReservation->tour_operator_reservation_id = $reservationId;
                    $existingReservation->save();
                }
            } else {
                $customTourBookingReservation = new customTourBookingReservations();
                $customTourBookingReservation->touristic_attraction_id = $attractionId;
                $customTourBookingReservation->tour_operator_reservation_id = $reservationId;
                $customTourBookingReservation->custom_tour_booking_id = $customTourBooking->id;
                $customTourBookingReservation->save();
            }
        }
    }

}
