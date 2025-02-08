<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackagePriceExclusive;

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourpackagePriceExclusive\localTourPackagePriceExclusive;
use App\Repositories\BaseRepository;


/**
 * Class localTourPackagePriceExclusiveRepository.
 */
class localTourPackagePriceExclusiveRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackagePriceExclusive::class;
    }
    public function storeLocalTourPackagePriceExclusive($input,$localTourPackage)
    {
        foreach ($input as $key => $value)
        {
            if (str_contains($key,'item')!==false)
            {
                $key_id=substr($key,4);
                $localTourPackagePriceExclusiveArray=[
                    'item'=>$input['item'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackagePriceExclusive=new localTourPackagePriceExclusive();
                $localTourPackagePriceExclusive->item=$localTourPackagePriceExclusiveArray['item'];
                $localTourPackagePriceExclusive->local_tour_package_id=$localTourPackagePriceExclusiveArray['local_tour_package_id'];
                $localTourPackagePriceExclusive->tour_operator_id=$localTourPackagePriceExclusiveArray['tour_operator_id'];
                $localTourPackagePriceExclusive->save();
            }
        }
    }
    public function updateLocalTourPackagePriceExclusives($input,$localTourPackage)
    {
        foreach ($input as $key =>$value)
        {
            if (str_contains($key,'item')!==false)
            {
                $key_id=substr($key,4);
                $localTourPackagePriceExclusiveArray=[
                    'item'=>$input['item'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackagePriceExclusive=localTourPackagePriceExclusive::query()->where('local_tour_package_id',$localTourPackage->id)->where('id',$key_id)->first();
                if ($localTourPackagePriceExclusive)
                {
                    $localTourPackagePriceExclusive->item=$input['item'.$key_id];
                    $localTourPackagePriceExclusive->save();
                }
                else
                {
                    $localTourPackagePriceExclusive=new localTourPackagePriceExclusive();
                    $localTourPackagePriceExclusive->item=$localTourPackagePriceExclusiveArray['item'];
                    $localTourPackagePriceExclusive->local_tour_package_id=$localTourPackagePriceExclusiveArray['local_tour_package_id'];
                    $localTourPackagePriceExclusive->tour_operator_id=$localTourPackagePriceExclusiveArray['tour_operator_id'];
                    $localTourPackagePriceExclusive->save();
                }
            }
        }
    }
}
