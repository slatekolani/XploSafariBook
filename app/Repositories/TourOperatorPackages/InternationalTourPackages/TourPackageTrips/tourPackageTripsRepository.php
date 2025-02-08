<?php

namespace App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageTrips;

use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageTrips\tourPackageTrips;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourPackageTripsRepository.
 */
class tourPackageTripsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourPackageTrips::class;
    }
    public function storeTourPackageTrips($input , $tourPackage)
    {
        foreach ($input as $key=>$value)
        {
            if (str_contains($key,'safari_trip_description')!==false)
            {
                $key_id=substr($key,23);
                $tourPackageTripsArray=[
                    'day_number'=>$input['day_number'.$key_id],
                    'safari_trip_name'=>$input['safari_trip_name'.$key_id],
                    'safari_trip_description'=>$input['safari_trip_description'.$key_id],
                    'tour_operator_id'=>$tourPackage->tourOperator->id,
                    'tour_package_id'=>$tourPackage->id,
                ];
                $tourPackageTrips=new tourPackageTrips();
                $tourPackageTrips->day_number=$tourPackageTripsArray['day_number'];
                $tourPackageTrips->safari_trip_name=$tourPackageTripsArray['safari_trip_name'];
                $tourPackageTrips->safari_trip_description=$tourPackageTripsArray['safari_trip_description'];
                $tourPackageTrips->tour_operator_id=$tourPackageTripsArray['tour_operator_id'];
                $tourPackageTrips->tour_package_id=$tourPackageTripsArray['tour_package_id'];
                $tourPackageTrips->save();
            }
        }
    }
}
