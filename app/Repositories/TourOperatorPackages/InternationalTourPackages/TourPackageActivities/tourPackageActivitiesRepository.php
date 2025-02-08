<?php

namespace App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageActivities;

use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageActivities\tourPackageActivities;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourPackageActivitiesRepository.
 */
class tourPackageActivitiesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourPackageActivities::class;
    }

    public function storeTourPackageActivities($input,$tourPackage)
    {
        foreach ($input as $key => $value)
        {
            if(str_contains($key,'activity_description')!==false)
            {
                $key_id=substr($key,20);
                $tourPackageActivityArray=[
                    'activity_name'=>$input['activity_name'.$key_id],
                    'activity_description'=>$input['activity_description'.$key_id],
                    'tour_package_id'=>$tourPackage->id,
                    'tour_operator_id'=>$tourPackage->tourOperator->id,
                ];
             $tourPackageActivity=new tourPackageActivities();
             $tourPackageActivity->activity_name=$tourPackageActivityArray['activity_name'];
             $tourPackageActivity->activity_description=$tourPackageActivityArray['activity_description'];
             $tourPackageActivity->tour_package_id=$tourPackageActivityArray['tour_package_id'];
             $tourPackageActivity->tour_operator_id=$tourPackageActivityArray['tour_operator_id'];
             $tourPackageActivity->save();
            }
        }
    }

}
