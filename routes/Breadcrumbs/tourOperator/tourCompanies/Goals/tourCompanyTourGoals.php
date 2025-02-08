<?php

use App\Models\TourOperator\TourCompanyLocalToursGoals\tourCompanyLocalToursGoals;
use App\Models\TourOperator\tourOperator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('tourCompanyLocalToursGoals.index', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('tourOperator.index');
    $breadcrumbs->push(trans('Company Analytics'), route('tourCompanyLocalToursGoals.index',$tourOperatorUuid));
});
Breadcrumbs::register('tourCompanyLocalToursGoals.edit', function ($breadcrumbs,$tourOperatorLocalToursGoalsUuid) {
    $tourOperatorLocalTourGoal=tourCompanyLocalToursGoals::query()->where('uuid',$tourOperatorLocalToursGoalsUuid)->first();
    $tourOperator=tourOperator::query()->where('id',$tourOperatorLocalTourGoal->tour_operator_id)->first();
    $breadcrumbs->parent('tourCompanyLocalToursGoals.index',$tourOperator->uuid);
    $breadcrumbs->push(trans('Edit Company Analytics'), route('tourCompanyLocalToursGoals.edit',$tourOperatorLocalToursGoalsUuid));
});

