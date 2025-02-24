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
        $customTourBooking=new customTourBookings();
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
        $customTourBooking->message=$input['message'];
        $customTourBooking->tour_operator_id=$input['tour_operator_id'];
        $customTourBooking->user_id=$input['user_id'];
        $customTourBooking->reference_number=$reference_number;
        $customTourBooking->save();
        $customTourBooking->getCustomTourBookingTouristAttractions($input,$customTourBooking);
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
        $customTourBooking->user_id=$input['user_id'];
        $customTourBooking->save();
        $customTourBooking->getCustomTourBookingTouristAttractions($input,$customTourBooking);
        $customTourBooking->saveCustomTourBookingReservations($input,$customTourBooking);
        $customTourBooking->saveCustomTourBookingTourPrices($input,$customTourBooking);
    }
}
