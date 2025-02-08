<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageBooking\localTripCancellation;

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTripCancellation\localTourPackageCancelledbookings;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tanzaniaAndWorldEventsRepository.
 */
class localTripCancellationRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackageCancelledbookings::class;
    }

    public function storeLocalTripCancelledBooking($input)
    {
        $cancelledBooking=new localTourPackageCancelledbookings();
        $cancelledBooking->cancellation_type=$input['cancellation_type'];
        $cancelledBooking->cancellation_reason=$input['cancellation_reason'];
        $cancelledBooking->cancellation_reason_description=$input['cancellation_reason_description'];
        $cancelledBooking->accept_cancellation_policy=$input['accept_cancellation_policy'];
        $cancelledBooking->local_tour_booking_id=$input['local_tour_booking_id'];    
        $cancelledBooking->save();
    }
    public function updateLocalTripCancelledBooking($input,$localTripCancellationUuid)
    {
        $cancelledBooking=localTourPackageCancelledbookings::query()->where('uuid',$localTripCancellationUuid)->first();
        $cancelledBooking->cancellation_type=$input['cancellation_type'];
        $cancelledBooking->cancellation_reason=$input['cancellation_reason'];
        $cancelledBooking->cancellation_reason_description=$input['cancellation_reason_description'];
        $cancelledBooking->accept_cancellation_policy=$input['accept_cancellation_policy'];
        $cancelledBooking->local_tour_booking_id=$input['local_tour_booking_id'];    
        $cancelledBooking->save();
    }
}
