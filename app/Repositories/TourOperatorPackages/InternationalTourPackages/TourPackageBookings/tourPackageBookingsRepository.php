<?php

namespace App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageBookings;

use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageBookings\tourPackageBookings;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourPackageBookingsRepository.
 */
class tourPackageBookingsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourPackageBookings::class;
    }

    public function storeTourPackageBookings(array $input)
    {
     $tourPackageBookings=new tourPackageBookings();
     $tourPackageBookings->tourist_name=$input['tourist_name'];
     $tourPackageBookings->tourist_email_address=$input['tourist_email_address'];
     $tourPackageBookings->tourist_country=$input['tourist_country'];
     $tourPackageBookings->tourist_phone_number=$input['tourist_phone_number'];
     $tourPackageBookings->total_adult_travellers=$input['total_adult_travellers'];
     $tourPackageBookings->total_children_travellers=$input['total_children_travellers'];
     $tourPackageBookings->message=$input['message'];
     $tourPackageBookings->tour_operator_id=$input['tour_operator_id'];
     $tourPackageBookings->tour_package_id=$input['tour_package_id'];
     $tourPackageBookings->save();
    }
    public function updateTourPackageBookingInformation(array $input, $tour_package_booking)
    {
        $tourPackageBookings=tourPackageBookings::query()->where('uuid',$tour_package_booking)->first();
        $tourPackageBookings->tourist_name=$input['tourist_name'];
        $tourPackageBookings->tourist_email_address=$input['tourist_email_address'];
        $tourPackageBookings->tourist_country=$input['tourist_country'];
        $tourPackageBookings->tourist_phone_number=$input['tourist_phone_number'];
        $tourPackageBookings->total_adult_travellers=$input['total_adult_travellers'];
        $tourPackageBookings->total_children_travellers=$input['total_children_travellers'];
        $tourPackageBookings->message=$input['message'];
        $tourPackageBookings->tour_operator_id=$input['tour_operator_id'];
        $tourPackageBookings->tour_package_id=$input['tour_package_id'];
        $tourPackageBookings->save();
    }
}
