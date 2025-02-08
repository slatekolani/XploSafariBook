<?php

namespace App\Repositories\customTourPackages;

use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class customTourBookingsRepository.
 */
class customTourBookingsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return customTourBookings::class;
    }

    public function storeCustomTourBookings(array $input,$reference_number)
    {
        $customTourBookings=new customTourBookings();
        $customTourBookings->tourist_name=$input['tourist_name'];
        $customTourBookings->tourist_email_address=$input['tourist_email_address'];
        $customTourBookings->tourist_region=$input['tourist_region'];
        $customTourBookings->tourist_phone_number=$input['tourist_phone_number'];
        $customTourBookings->start_date=$input['start_date'];
        $customTourBookings->end_date=$input['end_date'];
        $customTourBookings->tour_type=$input['tour_type'];
        $customTourBookings->tour_package_type=$input['tour_package_type'];
        $customTourBookings->transport_type=$input['transport_type'];
        $customTourBookings->special_need_description=$input['special_need_description'];
        $customTourBookings->total_adult_foreigners=$input['total_adult_foreigners'];
        $customTourBookings->total_children_foreigners=$input['total_children_foreigners'];
        $customTourBookings->total_children_residents=$input['total_children_residents'];
        $customTourBookings->total_adult_residents=$input['total_adult_residents'];
        $customTourBookings->reservation_needed=$input['reservation_needed'];
        $customTourBookings->message=$input['message'];
        $customTourBookings->tour_operator_id=$input['tour_operator_id'];
        $customTourBookings->reference_number=$reference_number;
        $customTourBookings->save();
        $customTourBookings->getCustomTourBookingTouristAttractions($input,$customTourBookings);
    }

    public function updateCustomTourBooking(array $input, $customTourBooking)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$customTourBooking)->first();
        $customTourBooking->tourist_name=$input['tourist_name'];
        $customTourBooking->tourist_email_address=$input['tourist_email_address'];
        $customTourBooking->tourist_region=$input['tourist_region'];
        $customTourBooking->tourist_phone_number=$input['tourist_phone_number'];
        $customTourBooking->start_date=$input['start_date'];
        $customTourBooking->end_date=$input['end_date'];
        $customTourBooking->tour_type=$input['tour_type'];
        $customTourBooking->tour_package_type=$input['tour_package_type'];
        $customTourBooking->transport_type=$input['transport_type'];
        $customTourBooking->special_need_description=$input['special_need_description'];
        $customTourBooking->total_adult_foreigners=$input['total_adult_foreigners'];
        $customTourBooking->total_children_foreigners=$input['total_children_foreigners'];
        $customTourBooking->total_children_residents=$input['total_children_residents'];
        $customTourBooking->total_adult_residents=$input['total_adult_residents'];
        $customTourBooking->reservation_needed=$input['reservation_needed'];
        $customTourBooking->discount=$input['discount'];
        $customTourBooking->message=$input['message'];
        $customTourBooking->due_payment_time=$input['due_payment_time'];
        $customTourBooking->tour_operator_id=$input['tour_operator_id'];
        $customTourBooking->save();
        $customTourBooking->getCustomTourBookingTouristAttractions($input,$customTourBooking);
        $customTourBooking->saveCustomTourBookingReservations($input,$customTourBooking);
        $customTourBooking->saveCustomTourBookingTourPrices($input,$customTourBooking);
    }
}
