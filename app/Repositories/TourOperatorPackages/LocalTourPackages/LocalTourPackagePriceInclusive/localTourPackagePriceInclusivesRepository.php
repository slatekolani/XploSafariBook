<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackagePriceInclusive;

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackagePriceInclusive\localTourPackagePriceInclusives;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class localTourPackagePriceInclusivesRepository.
 */
class localTourPackagePriceInclusivesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackagePriceInclusives::class;
    }
    public function storeLocalTourPackagePriceInclusive($input,$localTourPackage)
    {
        foreach($input as $key =>$value)
        {
            if (str_contains($key,'item')!==false)
            {
                $key_id=substr($key,4);
                $localTourPackagePriceInclusiveArray=[
                    'item'=>$input['item'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackagePriceInclusive=new localTourPackagePriceInclusives();
                $localTourPackagePriceInclusive->item=$localTourPackagePriceInclusiveArray['item'];
                $localTourPackagePriceInclusive->local_tour_package_id=$localTourPackagePriceInclusiveArray['local_tour_package_id'];
                $localTourPackagePriceInclusive->tour_operator_id=$localTourPackagePriceInclusiveArray['tour_operator_id'];
                $localTourPackagePriceInclusive->save();
            }
        }
    }
    public function updateLocalTourPackagePriceInclusives($input,$localTourPackage)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'item')!==false)
            {
                $key_id=substr($key,4);
                $localTourPackagePriceInclusiveArray=[
                    'item'=>$input['item'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackagePriceInclusive=localTourPackagePriceInclusives::query()->where('local_tour_package_id',$localTourPackage->id)->where('id',$key_id)->first();
                if ($localTourPackagePriceInclusive){
                    $localTourPackagePriceInclusive->item=$input['item'.$key_id];
                    $localTourPackagePriceInclusive->save();
                }
                else
                {
                    $localTourPackagePriceInclusive=new localTourPackagePriceInclusives();
                    $localTourPackagePriceInclusive->item=$localTourPackagePriceInclusiveArray['item'];
                    $localTourPackagePriceInclusive->local_tour_package_id=$localTourPackagePriceInclusiveArray['local_tour_package_id'];
                    $localTourPackagePriceInclusive->tour_operator_id=$localTourPackagePriceInclusiveArray['tour_operator_id'];
                    $localTourPackagePriceInclusive->save();
                }
            }
        }
    }
}
