<?php

namespace App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageAccommodations;

use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageAccommodations\tourPackageAccommodations;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourPackageAccommodationsRepository.
 */
class tourPackageAccommodationsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourPackageAccommodations::class;
    }
    public function storeTourPackageAccommodations($input, $tourPackage)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'accommodation_description')!==false)
            {
                $key_id=substr($key,25);
                $tourPackageAccommodationsArray=[
                    'day_number'=>$input['day_number'.$key_id],
                    'accommodation_name'=>$input['accommodation_name'.$key_id],
                    'accommodation_description'=>$input['accommodation_description'.$key_id],
                    'accommodation_link'=>$input['accommodation_link'.$key_id],
                    'tour_operator_id'=>$tourPackage->tourOperator->id,
                    'tour_package_id'=>$tourPackage->id,
                ];
                $tourPackageAccommodations=new tourPackageAccommodations();
                $tourPackageAccommodations->day_number=$tourPackageAccommodationsArray['day_number'];
                $tourPackageAccommodations->accommodation_name=$tourPackageAccommodationsArray['accommodation_name'];
                $tourPackageAccommodations->accommodation_description=$tourPackageAccommodationsArray['accommodation_description'];
                $tourPackageAccommodations->accommodation_link=$tourPackageAccommodationsArray['accommodation_link'];
                $tourPackageAccommodations->tour_operator_id=$tourPackageAccommodationsArray['tour_operator_id'];
                $tourPackageAccommodations->tour_package_id=$tourPackageAccommodationsArray['tour_package_id'];
                $tourPackageAccommodations->save();
            }
        }
    }
}
