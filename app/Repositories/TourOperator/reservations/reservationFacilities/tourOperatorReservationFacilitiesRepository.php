<?php

namespace App\Repositories\TourOperator\reservations\reservationFacilities;

use App\Models\TourOperator\reservations\reservationFacilities\tourOperatorReservationFacility;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourOperatorReservationFacilitiesRepository.
 */
class tourOperatorReservationFacilitiesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourOperatorReservationFacility::class;
    }
    public function saveReservationFacilities($input,$tourOperatorReservations)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'facility_description')!==false)
            {
                $key_id=substr($key,20);
                $reservationFacilitiesArray=[
                    'facility_name'=>$input['facility_name'.$key_id],
                    'facility_description'=>$input['facility_description'.$key_id],
                    'tour_operator_reservation_id'=>$tourOperatorReservations->id,
                    'tour_operator_id'=>$tourOperatorReservations->tourOperator->id,
                ];
                $tourOperatorReservationFacility=new tourOperatorReservationFacility();
                $tourOperatorReservationFacility->facility_name=$reservationFacilitiesArray['facility_name'];
                $tourOperatorReservationFacility->facility_description=$reservationFacilitiesArray['facility_description'];
                $tourOperatorReservationFacility->tour_operator_reservation_id=$reservationFacilitiesArray['tour_operator_reservation_id'];
                $tourOperatorReservationFacility->tour_operator_id=$reservationFacilitiesArray['tour_operator_id'];
                $tourOperatorReservationFacility->save();
            }
        }
    }
    public function updateReservationFacilities($input,$tourOperatorReservation)
    {
        foreach($input as $key =>$value)
        {
            if (str_contains($key,'facility_description')!==false)
            {
                $key_id=substr($key,20);
                $reservationFacilityArray=[
                    'facility_name'=>$input['facility_name'.$key_id],
                    'facility_description'=>$input['facility_description'.$key_id],
                    'tour_operator_reservation_id'=>$tourOperatorReservation->id,
                    'tour_operator_id'=>$tourOperatorReservation->tourOperator->id,
                ];
                $tourOperatorReservationsFacility=tourOperatorReservationFacility::query()->where('tour_operator_reservation_id',$tourOperatorReservation->id)->where('id',$key_id)->first();
                if ($tourOperatorReservationsFacility)
                {
                    $tourOperatorReservationsFacility->facility_name=$input['facility_name'.$key_id];
                    $tourOperatorReservationsFacility->facility_description=$input['facility_description'.$key_id];
                    $tourOperatorReservationsFacility->save();
                }
                else
                {
                    $tourOperatorReservationFacility=new tourOperatorReservationFacility();
                    $tourOperatorReservationFacility->facility_name=$reservationFacilityArray['facility_name'];
                    $tourOperatorReservationFacility->facility_description=$reservationFacilityArray['facility_description'];
                    $tourOperatorReservationFacility->tour_operator_reservation_id=$reservationFacilityArray['tour_operator_reservation_id'];
                    $tourOperatorReservationFacility->tour_operator_id=$reservationFacilityArray['tour_operator_id'];
                    $tourOperatorReservationFacility->save();
                }
            }
        }
    }
}
