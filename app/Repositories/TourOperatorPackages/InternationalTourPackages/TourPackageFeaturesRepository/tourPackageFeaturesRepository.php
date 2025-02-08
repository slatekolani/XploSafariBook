<?php

namespace App\Repositories\TourOperatorPackages\InternationalTourPackages\TourPackageFeaturesRepository;

use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackageFeatures\tourPackageFeatures;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourPackageFeaturesRepository.
 */
class tourPackageFeaturesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourPackageFeatures::class;
    }

    public function storeTourpackageFeatures($input, $tourPackage)
    {
        foreach($input as $key =>$value)
        {
            if(str_contains($key,'feature_description')!==false)
            {
                $key_id=substr($key,19);
                $tourPackageFeaturesArray=[
                    'feature_name'=>$input['feature_name'.$key_id],
                    'feature_description'=>$input['feature_description'.$key_id],
                    'tour_package_id'=>$tourPackage->id,
                    'tour_operator_id'=>$tourPackage->tourOperator->id,
                ];
                $tourPackageFeatures=new tourPackageFeatures();
                $tourPackageFeatures->feature_name=$tourPackageFeaturesArray['feature_name'];
                $tourPackageFeatures->feature_description=$tourPackageFeaturesArray['feature_description'];
                $tourPackageFeatures->tour_operator_id=$tourPackageFeaturesArray['tour_operator_id'];
                $tourPackageFeatures->tour_package_id=$tourPackageFeaturesArray['tour_package_id'];
                $tourPackageFeatures->save();
            }
        }
    }
}
