<?php

namespace App\Repositories\TourOperator\TourCompanyLocalToursGoals\packageSegmentation;

use App\Models\TourOperator\TourCompanyLocalToursGoals\packageSegmentation\localTourGoalsPackageSegmentation;
use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Repositories\BaseRepository;


/**
 */
class tourCompanyLocalToursGoalsPackageSegmentationRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourGoalsPackageSegmentation::class;
    }
    public function storeLocalTourGoalPackageSegmentation($input, $tourCompanyLocalToursGoal)
    {
        if (
            isset($input['package_type']) &&
            isset($input['total_tours']) &&
            isset($input['total_travellers'])
        ) {

            foreach ($input['package_type'] as $key => $packageTypeId) {
                if (
                    !empty($packageTypeId) &&
                    isset($input['total_tours'][$key]) &&
                    isset($input['total_travellers'][$key])
                ) {

                    $packageSegmentation = new localTourGoalsPackageSegmentation();
                    $packageSegmentation->package_type = $packageTypeId;
                    $packageSegmentation->total_tours = $input['total_tours'][$key];
                    $packageSegmentation->total_travellers = $input['total_travellers'][$key];
                    $packageSegmentation->tour_operator_id = $tourCompanyLocalToursGoal->tour_operator_id;
                    $packageSegmentation->goal_id = $tourCompanyLocalToursGoal->id;
                    $packageSegmentation->save();
                }
            }
        }

        return true;
    }
    public function updateLocalTourGoalsPackageSegmentation($input, $tourCompanyLocalToursGoal)
    {
        $localTourGoal=tourCompanyLocalToursGoals::query()->where('uuid',$tourCompanyLocalToursGoal->uuid)->first();
        $existingIds=localTourGoalsPackageSegmentation::query()->where('goal_id',$localTourGoal->id)->get();

        $updatedIds = [];

        if (isset($input['package_type']) && isset($input['total_tours']) && isset($input['total_travellers'])) {
            foreach ($input['package_type'] as $key => $packageTypeId) {
                if (!empty($packageTypeId) && isset($input['total_tours'][$key]) && isset($input['total_travellers'][$key])) {
                    $segmentationId = !empty($input['segmentation_id'][$key]) ? $input['segmentation_id'][$key] : null;

                    if ($segmentationId) {
                        $packageSegmentation = localTourGoalsPackageSegmentation::find($segmentationId);
                        if ($packageSegmentation) {
                            $updatedIds[] = $segmentationId;

                            $packageSegmentation->package_type = $packageTypeId;
                            $packageSegmentation->total_tours = $input['total_tours'][$key];
                            $packageSegmentation->total_travellers = $input['total_travellers'][$key];
                            $packageSegmentation->save();
                        }
                    } else {
                        $packageSegmentation = new localTourGoalsPackageSegmentation();

                        $packageSegmentation->package_type = $packageTypeId;
                        $packageSegmentation->total_tours = $input['total_tours'][$key];
                        $packageSegmentation->total_travellers = $input['total_travellers'][$key];
                        $packageSegmentation->goal_id = $tourCompanyLocalToursGoal->id;
                        $packageSegmentation->tour_operator_id = $tourCompanyLocalToursGoal->tour_operator_id;
                        $packageSegmentation->save();
                        $updatedIds[] = $packageSegmentation->id;
                    }
                }
            }
        }

        return true;
    }
}
