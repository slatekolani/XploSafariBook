<?php

namespace App\Repositories\TourOperator\TourCompanyLocalToursGoals;

use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Repositories\BaseRepository;

//use Your Model

/**
 * Class tourOperatorReservationRepository.
 */
class tourCompanyLocalToursGoalsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourCompanyLocalToursGoals::class;
    }
    public function storeTourCompanyLocalToursGoals($input)
    {
        $tourCompanyLocalToursGoal=new tourCompanyLocalToursGoals();
        $tourCompanyLocalToursGoal->goal_description=$input['goal_description'];
        $tourCompanyLocalToursGoal->year=$input['year'];
        $tourCompanyLocalToursGoal->number_of_tours_to_be_made=$input['number_of_tours_to_be_made'];
        $tourCompanyLocalToursGoal->number_of_travellers=$input['number_of_travellers'];
        $tourCompanyLocalToursGoal->number_of_mail_subscribers=$input['number_of_mail_subscribers'];
        $tourCompanyLocalToursGoal->number_of_tour_reviewers=$input['number_of_tour_reviewers'];
        $tourCompanyLocalToursGoal->projected_revenue=$input['projected_revenue'];
        $tourCompanyLocalToursGoal->tour_operator_id=$input['tour_operator_id'];
        $tourCompanyLocalToursGoal->save();
        $tourCompanyLocalToursGoal->saveLocalTourGoalsProjectedRevenue($input,$tourCompanyLocalToursGoal);
        $tourCompanyLocalToursGoal->saveLocalTourGoalsPackageSegmentation($input,$tourCompanyLocalToursGoal);
    }

    public function updateTourCompanyLocalToursGoals($input,$tourOperatorLocalToursGoalsUuid)
    {
        $tourCompanyLocalToursGoal=tourCompanyLocalToursGoals::query()->where('uuid',$tourOperatorLocalToursGoalsUuid)->first();
        $tourCompanyLocalToursGoal->goal_description=$input['goal_description'];
        $tourCompanyLocalToursGoal->year=$input['year'];
        $tourCompanyLocalToursGoal->number_of_tours_to_be_made=$input['number_of_tours_to_be_made'];
        $tourCompanyLocalToursGoal->number_of_travellers=$input['number_of_travellers'];
        $tourCompanyLocalToursGoal->number_of_mail_subscribers=$input['number_of_mail_subscribers'];
        $tourCompanyLocalToursGoal->number_of_tour_reviewers=$input['number_of_tour_reviewers'];
        $tourCompanyLocalToursGoal->projected_revenue=$input['projected_revenue'];
        $tourCompanyLocalToursGoal->tour_operator_id=$input['tour_operator_id'];
        $tourCompanyLocalToursGoal->save();
        $tourCompanyLocalToursGoal->updateLocalTourGoalsProjectedRevenue($input,$tourCompanyLocalToursGoal);
        $tourCompanyLocalToursGoal->updateLocalTourGoalsPackageSegmentation($input,$tourCompanyLocalToursGoal);
    }
}
