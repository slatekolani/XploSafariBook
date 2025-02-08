<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\LocalTourPackageCollectionStops;

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageCollectionStops\localTourPackageCollectionStops;
use App\Repositories\BaseRepository;


/**
 * Class localTourPackageCollectionStopsRepository.
 */
class localTourPackageCollectionStopsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackageCollectionStops::class;
    }
    public function storeLocalTourPackageCollectionStops($input, $localTourPackage)
    {
        foreach ($input as $key => $value)
        {
            if(str_contains($key,'collection_stop_name')!==false)
            {
                $key_id=substr($key,20);
                $localTourPackageCollectionStopsArray=[
                    'collection_stop_name'=>$input['collection_stop_name'.$key_id],
                    'collection_stop_price'=>$input['collection_stop_price'.$key_id],
                    'pick_up_time'=>$input['pick_up_time'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackageCollectionStops=new localTourPackageCollectionStops();
                $localTourPackageCollectionStops->collection_stop_name=$localTourPackageCollectionStopsArray['collection_stop_name'];
                $localTourPackageCollectionStops->collection_stop_price=$localTourPackageCollectionStopsArray['collection_stop_price'];
                $localTourPackageCollectionStops->pick_up_time=$localTourPackageCollectionStopsArray['pick_up_time'];
                $localTourPackageCollectionStops->local_tour_package_id=$localTourPackageCollectionStopsArray['local_tour_package_id'];
                $localTourPackageCollectionStops->tour_operator_id=$localTourPackageCollectionStopsArray['tour_operator_id'];
                $localTourPackageCollectionStops->save();
            }
        }
    }
    public function updateLocalTourPackageCollectionStops($input,$localTourPackage)
    {
        foreach($input as $key =>$value)
        {
            if (str_contains($key,'collection_stop_name')!==false)
            {
                $key_id=substr($key,20);
                $localTourPackageCollectionStopsArray=[
                    'collection_stop_name'=>$input['collection_stop_name'.$key_id],
                    'collection_stop_price'=>$input['collection_stop_price'.$key_id],
                    'pick_up_time'=>$input['pick_up_time'.$key_id],
                    'local_tour_package_id'=>$localTourPackage->id,
                    'tour_operator_id'=>$localTourPackage->tourOperator->id,
                ];
                $localTourPackageCollectionStop=localTourPackageCollectionStops::query()->where('local_tour_package_id',$localTourPackage->id)->where('id',$key_id)->first();
                if ($localTourPackageCollectionStop)
                {
                    $localTourPackageCollectionStop->collection_stop_name=$input['collection_stop_name'.$key_id];
                    $localTourPackageCollectionStop->collection_stop_price=$input['collection_stop_price'.$key_id];
                    $localTourPackageCollectionStop->pick_up_time=$input['pick_up_time'.$key_id];
                    $localTourPackageCollectionStop->save();
                }
                else
                {
                    $localTourPackageCollectionStops=new localTourPackageCollectionStops();
                    $localTourPackageCollectionStops->collection_stop_name=$localTourPackageCollectionStopsArray['collection_stop_name'];
                    $localTourPackageCollectionStops->collection_stop_price=$localTourPackageCollectionStopsArray['collection_stop_price'];
                    $localTourPackageCollectionStops->pick_up_time=$localTourPackageCollectionStopsArray['pick_up_time'];
                    $localTourPackageCollectionStops->local_tour_package_id=$localTourPackageCollectionStopsArray['local_tour_package_id'];
                    $localTourPackageCollectionStops->tour_operator_id=$localTourPackageCollectionStopsArray['tour_operator_id'];
                    $localTourPackageCollectionStops->save();
                }
            }
        }
    }
}
