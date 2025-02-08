<?php

namespace App\Repositories\TourOperator\TourCompanyLocalToursGoals\projectedRevenue;

use App\Models\TourOperator\TourCompanyLocalToursGoals\projectedRevenue\localTourGoalsProjectedRevenue;
use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Repositories\BaseRepository;


/**
 */
class localToursGoalsProjectedRevenueRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return localTourGoalsProjectedRevenue::class;
    }
    public function storeLocalTourGoalsProjectedRevenue($input, $tourCompanyLocalToursGoal)
    {
        if (isset($input['month']) && isset($input['revenue_breakdown'])) {
            foreach ($input['month'] as $key => $month) {
                if (!empty($month) && isset($input['revenue_breakdown'][$key])) {
                    $revenueProjection = new localTourGoalsProjectedRevenue();
                    $revenueProjection->month = $month;
                    $revenueProjection->revenue_breakdown = $input['revenue_breakdown'][$key];
                    $revenueProjection->tour_operator_id = $tourCompanyLocalToursGoal->tour_operator_id;
                    $revenueProjection->local_tours_goals_id = $tourCompanyLocalToursGoal->id;
                    $revenueProjection->save();
                }
            }
        }
        return true;
    }
   
    
    public function updateLocalTourGoalsProjectedRevenue($input,$tourCompanyLocalToursGoal)
    {
    // Get all current revenue breakdown IDs for this goal
    $tourCompanyLocalTourGoal=tourCompanyLocalToursGoals::query()->where('uuid',$tourCompanyLocalToursGoal->uuid)->first();
    $existingIds=localTourGoalsProjectedRevenue::query()->where('local_tours_goals_id',$tourCompanyLocalTourGoal->id)->get();    
    $updatedIds = [];
    
    if (isset($input['month']) && isset($input['revenue_breakdown'])) {
        foreach ($input['month'] as $key => $month) {
            if (!empty($month) && isset($input['revenue_breakdown'][$key])) {
                $breakdownId = !empty($input['breakdown_id'][$key]) ? $input['breakdown_id'][$key] : null;
                
                if ($breakdownId) {
                    $revenueProjection = localTourGoalsProjectedRevenue::find($breakdownId);
                    if ($revenueProjection) {
                        $updatedIds[] = $breakdownId;
                        
                        $revenueProjection->month = $month;
                        $revenueProjection->revenue_breakdown = $input['revenue_breakdown'][$key];
                        $revenueProjection->save();
                    }
                } else {
                    $revenueProjection = new localTourGoalsProjectedRevenue();
                    
                    $revenueProjection->month = $month;
                    $revenueProjection->revenue_breakdown = $input['revenue_breakdown'][$key];
                    $revenueProjection->local_tours_goals_id = $tourCompanyLocalToursGoal->id;
                    $revenueProjection->tour_operator_id=$tourCompanyLocalToursGoal->tour_operator_id;
                    $revenueProjection->save();
                    $updatedIds[] = $revenueProjection->id;
                }
            }
        }
    }
    
    return true;

    }
}
