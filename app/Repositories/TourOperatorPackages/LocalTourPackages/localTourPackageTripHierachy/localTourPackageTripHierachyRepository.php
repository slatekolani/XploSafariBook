<?php

namespace App\Repositories\TourOperatorPackages\LocalTourPackages\localTourPackageTripHierachy;

use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackageTripHierachy\localTourPackageTripHierachy;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class localTourPackageActivitiesRepository.
 */
class localTourPackageTripHierachyRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourPackageTripHierachy::class;
    }
    public function storeLocalTourPackageTripHierachies($input,$localTourPackage)
    {
        if (
            isset($input['day']) &&
            isset($input['travel_date']) &&
            isset($input['destination']) &&
            isset($input['reservation'])
        ) {

            foreach ($input['destination'] as $key => $destinationId) {
                if (
                    !empty($destinationId) &&
                    isset($input['day'][$key]) &&
                    isset($input['travel_date'][$key]) &&
                    isset($input['reservation'][$key])
                ) 
                {
                    $tourPackageTripHierachy = new localTourPackageTripHierachy();
                    $tourPackageTripHierachy->destination = $destinationId;
                    $tourPackageTripHierachy->day = $input['day'][$key];
                    $tourPackageTripHierachy->travel_date = $input['travel_date'][$key];
                    $tourPackageTripHierachy->reservation = $input['reservation'][$key];
                    $tourPackageTripHierachy->local_tour_package_id = $localTourPackage->id;
                    $tourPackageTripHierachy->save();
                }
            }
        }

        return true;
    }

    public function updateLocalTourPackageTripHierarchies($input, $localTourPackage)
{
    $existingHierarchies = localTourPackageTripHierachy::query()
        ->where('local_tour_package_id', $localTourPackage->id)
        ->get();
    
    $updatedIds = [];

    if (isset($input['day'], $input['travel_date'], $input['destination'], $input['reservation'])) {
        foreach ($input['destination'] as $key => $destinationId) {
            if (!empty($destinationId) && isset($input['day'][$key], $input['travel_date'][$key], $input['reservation'][$key])) {
                $hierarchyId = !empty($input['hierarchy_id'][$key]) ? $input['hierarchy_id'][$key] : null;

                if ($hierarchyId) {
                    $existingHierarchy = localTourPackageTripHierachy::find($hierarchyId);
                    if ($existingHierarchy) {
                        $updatedIds[] = $hierarchyId;

                        $existingHierarchy->day = $input['day'][$key];
                        $existingHierarchy->travel_date = $input['travel_date'][$key];
                        $existingHierarchy->destination = $destinationId;
                        $existingHierarchy->reservation = $input['reservation'][$key];
                        $existingHierarchy->save();
                    }
                } else {
                    $newHierarchy = new localTourPackageTripHierachy();
                    $newHierarchy->day = $input['day'][$key];
                    $newHierarchy->travel_date = $input['travel_date'][$key];
                    $newHierarchy->destination = $destinationId;
                    $newHierarchy->reservation = $input['reservation'][$key];
                    $newHierarchy->local_tour_package_id = $localTourPackage->id;
                    $newHierarchy->save();
                    $updatedIds[] = $newHierarchy->id;
                }
            }
        }
    }

    return true;
}

}
