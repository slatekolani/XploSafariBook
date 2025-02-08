<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageRequirement;

use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageRequirement\localTourPackageRequirements;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class localTourPackageRequirementsRepository.
 */
class localTourPackageRequirementsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackageRequirements::class;
    }
    public function storeLocalTourPackageRequirements($input, $localTourPackage)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'requirement_description')!==false)
            {
                $key_id=substr($key,23);
                $localTourPackageRequirementsArray=[
                    'requirement_name'=>$input['requirement_name'.$key_id],
                    'requirement_description'=>$input['requirement_description'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackageRequirements=new localTourPackageRequirements();
                $localTourPackageRequirements->requirement_name=$localTourPackageRequirementsArray['requirement_name'];
                $localTourPackageRequirements->requirement_description=$localTourPackageRequirementsArray['requirement_description'];
                $localTourPackageRequirements->local_tour_package_id=$localTourPackageRequirementsArray['local_tour_package_id'];
                $localTourPackageRequirements->tour_operator_id=$localTourPackageRequirementsArray['tour_operator_id'];
                $localTourPackageRequirements->save();
            }
        }
    }
    public function updateLocalTourPackageRequirements($input, $localTourPackage)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'requirement_description')!==false)
            {
                $key_id=substr($key,23);
                $localTourPackageRequirementsArray=[
                    'requirement_name'=>$input['requirement_name'.$key_id],
                    'requirement_description'=>$input['requirement_description'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackageRequirement=localTourPackageRequirements::query()->where('local_tour_package_id',$localTourPackage->id)->where('id',$key_id)->first();
                if ($localTourPackageRequirement)
                {
                    $localTourPackageRequirement->requirement_name=$input['requirement_name'.$key_id];
                    $localTourPackageRequirement->requirement_description=$input['requirement_description'.$key_id];
                    $localTourPackageRequirement->save();
                }
                else
                {
                    $localTourPackageRequirements=new localTourPackageRequirements();
                    $localTourPackageRequirements->requirement_name=$localTourPackageRequirementsArray['requirement_name'];
                    $localTourPackageRequirements->requirement_description=$localTourPackageRequirementsArray['requirement_description'];
                    $localTourPackageRequirements->local_tour_package_id=$localTourPackageRequirementsArray['local_tour_package_id'];
                    $localTourPackageRequirements->tour_operator_id=$localTourPackageRequirementsArray['tour_operator_id'];
                    $localTourPackageRequirements->save();
                }
            }
        }
    }
}
