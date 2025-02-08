<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageBooking;

use App\Mail\BookingNotification;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use Illuminate\Support\Facades\Mail;
use App\Repositories\BaseRepository;


/**
 * Class localTourPackageBookingRepository.
 */
class localTourPackageBookingRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackageBookings::class;
    }

    public function storeLocalTourBooking($input,$reference_number)
    {
        $localTourBooking=new localTourPackageBookings();
        $localTourBooking->tourist_name=$input['tourist_name'];
        $localTourBooking->phone_number=$input['phone_number'];
        $localTourBooking->email_address=$input['email_address'];
        $localTourBooking->total_number_foreigner_child=$input['total_number_foreigner_child'];
        $localTourBooking->total_number_local_child=$input['total_number_local_child'];
        $localTourBooking->total_number_foreigner_adult=$input['total_number_foreigner_adult'];
        $localTourBooking->total_number_local_adult=$input['total_number_local_adult'];
        $localTourBooking->collection_station=$input['collection_station'];
        $localTourBooking->message=$input['message'];
        $localTourBooking->payment_mode=$input['payment_mode'];
        $localTourBooking->special_attention=$input['special_attention'];
        $localTourBooking->reservation_id = $input['reservation_id']??null;
        $localTourBooking->accept_terms = $input['accept_terms'];
        $localTourBooking->payment_agreement=$input['payment_agreement'];
        $localTourBooking->user_id=$input['user_id'];
        $localTourBooking->tour_operator_id=$input['tour_operator_id'];
        $localTourBooking->reference_number=$reference_number;
        $localTourBooking->total_free_of_charge_children=$input['total_free_of_charge_children'];
        $localTourBooking->local_tour_package_id=$input['local_tour_package_id'];
        $localTourBooking->save();
           // Send message to the tour operator about new booking made
           $tourOperator=tourOperator::find($input['tour_operator_id']);
           $data=[
            'tourist_name'=>$input['tourist_name'],
            'phone_number'=>$input['phone_number'],
            'email_address'=>$input['email_address'],
            'collection_station'=>$input['collection_station'],
            'message'=>$input['message'],
// Tour operator email address
            'to_email'=>$tourOperator->email_address,
           ];
           Mail::to($data['to_email'])->send(new BookingNotification($data));
    }
    public function updateLocalTourBooking($input,$localTourBookingUuid)
    {
        $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
        $localTourBooking->tourist_name=$input['tourist_name'];
        $localTourBooking->phone_number=$input['phone_number'];
        $localTourBooking->email_address=$input['email_address'];
        $localTourBooking->total_number_foreigner_child=$input['total_number_foreigner_child'];
        $localTourBooking->total_number_local_child=$input['total_number_local_child'];
        $localTourBooking->total_number_foreigner_adult=$input['total_number_foreigner_adult'];
        $localTourBooking->total_number_local_adult=$input['total_number_local_adult'];
        $localTourBooking->collection_station=$input['collection_station'];
        $localTourBooking->message=$input['message'];
        $localTourBooking->payment_mode=$input['payment_mode'];
        $localTourBooking->special_attention=$input['special_attention'];
        $localTourBooking->reservation_id = $input['reservation_id']??null;
        $localTourBooking->tour_operator_id=$input['tour_operator_id'];
        $localTourBooking->user_id=$input['user_id'];
        $localTourBooking->accept_terms=$input['accept_terms'];
        $localTourBooking->payment_agreement=$input['payment_agreement'];
        $localTourBooking->total_free_of_charge_children=$input['total_free_of_charge_children'];
        $localTourBooking->local_tour_package_id=$input['local_tour_package_id'];
        $localTourBooking->save();
    }
}
