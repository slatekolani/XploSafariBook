<?php

use App\Models\TourOperator\reservations\tourOperatorReservation;
use App\Models\TourOperator\tourOperator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;




Breadcrumbs::register('tourOperator.verifiedCompaniesIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('tourOperator.index');
    $breadcrumbs->push(trans('Verified Companies'), route('tourOperator.verifiedCompaniesIndex'));
});

Breadcrumbs::register('tourOperator.UnverifiedCompaniesIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('tourOperator.index');
    $breadcrumbs->push(trans('Unverified Companies'), route('tourOperator.UnverifiedCompaniesIndex'));
});

Breadcrumbs::register('tourOperator.deletedTourCompaniesIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('tourOperator.index');
    $breadcrumbs->push(trans('Deleted Companies'), route('tourOperator.deletedTourCompaniesIndex'));
});


Breadcrumbs::register('tourOperatorReservation.index', function ($breadcrumbs,$tourCompanyUuid) {
    $breadcrumbs->parent('tourOperator.index');
    $breadcrumbs->push(trans('Reservations'), route('tourOperatorReservation.index',$tourCompanyUuid));
});

Breadcrumbs::register('tourOperatorReservation.show', function ($breadcrumbs, $tourOperatorReservationUuid) {
    $tourOperatorReservation = tourOperatorReservation::query()->where('uuid', $tourOperatorReservationUuid)->first();
    $tourCompany = tourOperator::query()->where('id', $tourOperatorReservation->tour_operator_id)->first();
    $breadcrumbs->parent('tourOperatorReservation.index', $tourCompany->uuid);
    $breadcrumbs->push(trans('View Reservation'), route('tourOperatorReservation.show', $tourOperatorReservationUuid)); // Use 'view' as the route name
});


Breadcrumbs::register('tourOperatorReservation.edit', function ($breadcrumbs, $tourOperatorReservationUuid) {
    $tourOperatorReservation = tourOperatorReservation::query()->where('uuid', $tourOperatorReservationUuid)->first();
    $tourCompany = tourOperator::query()->where('id', $tourOperatorReservation->tour_operator_id)->first();
    $breadcrumbs->parent('tourOperatorReservation.index', $tourCompany->uuid);
    $breadcrumbs->push(trans('Edit Reservation'), route('tourOperatorReservation.edit', $tourOperatorReservationUuid));
});













