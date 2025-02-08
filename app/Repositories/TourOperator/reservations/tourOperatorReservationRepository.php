<?php

namespace App\Repositories\TourOperator\reservations;

use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourOperatorReservationRepository.
 */
class tourOperatorReservationRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourOperatorReservation::class;
    }
    public function storeTourOperatorReservations($input)
    {
        $tourOperatorReservation=new tourOperatorReservation();
        $tourOperatorReservation->reservation_name=$input['reservation_name'];
        $tourOperatorReservation->reservation_capacity=$input['reservation_capacity'];
        $tourOperatorReservation->reservation_url=$input['reservation_url'];
        $tourOperatorReservation->region_found=$input['region_found'];
        $tourOperatorReservation->resident_child_price_reservation=$input['resident_child_price_reservation'];
        $tourOperatorReservation->resident_adult_price_reservation=$input['resident_adult_price_reservation'];
        $tourOperatorReservation->foreigner_adult_price_reservation=$input['foreigner_adult_price_reservation'];
        $tourOperatorReservation->foreigner_child_price_reservation=$input['foreigner_child_price_reservation'];
        $tourOperatorReservation->tour_operator_id=$input['tour_operator_id'];
        if ($input['reservation_images'] && is_array($input['reservation_images']))
        {
            $imagePaths=[];
            foreach($input['reservation_images'] as $image)
            {
                $extension=$image->getClientOriginalExtension();
                $filename=time().'_'.uniqid().'.'.$extension;
                $image->move('public/reservationImages/',$filename);
                $imagePaths[]='/reservationImages/'.$filename;
            }
            $tourOperatorReservation->reservation_images=implode(',',$imagePaths);
        }
        $tourOperatorReservation->save();
        $tourOperatorReservation->getReservationSafariAreaPreference($input,$tourOperatorReservation);
        $tourOperatorReservation->getTourOperatorReservationTouristicGame($input,$tourOperatorReservation);
        $tourOperatorReservation->saveReservationFacilities($input,$tourOperatorReservation);
    }

    public function updateTourOperatorReservation($input,$tourOperatorReservationUuid,$request)
    {
        $tourOperatorReservation=tourOperatorReservation::query()->where('uuid',$tourOperatorReservationUuid)->first();
        $tourOperatorReservation->reservation_name=$input['reservation_name'];
        $tourOperatorReservation->reservation_capacity=$input['reservation_capacity'];
        $tourOperatorReservation->reservation_url=$input['reservation_url'];
        $tourOperatorReservation->region_found=$input['region_found'];
        $tourOperatorReservation->resident_child_price_reservation=$input['resident_child_price_reservation'];
        $tourOperatorReservation->resident_adult_price_reservation=$input['resident_adult_price_reservation'];
        $tourOperatorReservation->foreigner_adult_price_reservation=$input['foreigner_adult_price_reservation'];
        $tourOperatorReservation->foreigner_child_price_reservation=$input['foreigner_child_price_reservation'];
        $tourOperatorReservation->tour_operator_id=$input['tour_operator_id'];
        $input=$request->all();
        if ($request->hasFile('reservation_images') && is_array($input['reservation_images']))
        {
            $imagePaths=[];
            foreach($input['reservation_images'] as $image)
            {
                $extension=$image->getClientOriginalExtension();
                $filename=time().'_'.uniqid().'.'.$extension;
                $image->move('public/reservationImages/',$filename);
                $imagePaths[]='/reservationImages/'.$filename;
            }
            $tourOperatorReservation->reservation_images=implode(',',$imagePaths);
        }
        $tourOperatorReservation->save();
        $tourOperatorReservation->getReservationSafariAreaPreference($input,$tourOperatorReservation);
        $tourOperatorReservation->getTourOperatorReservationTouristicGame($input,$tourOperatorReservation);
        $tourOperatorReservation->updateReservationFacilities($input,$tourOperatorReservation);
    }
}
