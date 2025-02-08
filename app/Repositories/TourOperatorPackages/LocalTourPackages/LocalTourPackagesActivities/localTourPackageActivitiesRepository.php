<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackagesActivities;

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageActivities\localTourPackageActivities;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class localTourPackageActivitiesRepository.
 */
class localTourPackageActivitiesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackageActivities::class;
    }
    public function storeLocalTourPackageActivities($input,$localTourPackage)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'activity_description')!==false)
            {
                $key_id=substr($key,20);
                $localTourPackageActivityArray=[
                    'activity_name'=>$input['activity_name'.$key_id],
                    'activity_description'=>$input['activity_description'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackageActivity=new localTourPackageActivities();
                $localTourPackageActivity->activity_name=$localTourPackageActivityArray['activity_name'];
                $localTourPackageActivity->activity_description=$localTourPackageActivityArray['activity_description'];
                $localTourPackageActivity->local_tour_package_id=$localTourPackageActivityArray['local_tour_package_id'];
                $localTourPackageActivity->tour_operator_id=$localTourPackageActivityArray['tour_operator_id'];
                $localTourPackageActivity->save();
            }
        }
    }
    public function updateLocalTourPackageActivities($input,$localTourPackage)
    {
        foreach($input as $key =>$value)
        {
            if (str_contains($key,'activity_description') !==false)
            {
                $key_id=substr($key,20);
                $localTourPackageActivityArray=[
                    'activity_name'=>$input['activity_name'.$key_id],
                    'activity_description'=>$input['activity_description'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackageActivity=localTourPackageActivities::query()->where('local_tour_package_id',$localTourPackage->id)->where('id',$key_id)->first();
                if ($localTourPackageActivity)
                {
                    $localTourPackageActivity->activity_name=$input['activity_name'.$key_id];
                    $localTourPackageActivity->activity_description=$input['activity_description'.$key_id];
                    $localTourPackageActivity->save();
                }
                else
                {
                    $localTourPackageActivity=new localTourPackageActivities();
                    $localTourPackageActivity->activity_name=$localTourPackageActivityArray['activity_name'];
                    $localTourPackageActivity->activity_description=$localTourPackageActivityArray['activity_description'];
                    $localTourPackageActivity->local_tour_package_id=$localTourPackageActivityArray['local_tour_package_id'];
                    $localTourPackageActivity->tour_operator_id=$localTourPackageActivityArray['tour_operator_id'];
                    $localTourPackageActivity->save();
                }
            }
        }
    }
}
