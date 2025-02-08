<?php

use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

    Breadcrumbs::register('tourPackageBookings.index', function ($breadcrumbs,$tourPackageId) {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourOperator=tourOperator::query()->where('id',$tourPackage->tour_operator_id)->first();
        $breadcrumbs->parent('tourPackages.index',$tourOperator->uuid);
        $breadcrumbs->push(trans('Tour Bookings'), route('tourPackageBookings.index',$tourPackageId));
    });

    Breadcrumbs::register('tourPackageBookings.ApprovedTourPackageBookingsIndex', function ($breadcrumbs,$tourPackageId) {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourOperator=tourOperator::query()->where('id',$tourPackage->tour_operator_id)->first();
        $breadcrumbs->parent('tourPackages.index',$tourOperator->uuid);
        $breadcrumbs->push(trans('Approved Tour Bookings'), route('tourPackageBookings.ApprovedTourPackageBookingsIndex',$tourPackageId));
    });

    Breadcrumbs::register('tourPackageBookings.unApprovedTourPackageBookingsIndex', function ($breadcrumbs,$tourPackageId) {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourOperator=tourOperator::query()->where('id',$tourPackage->tour_operator_id)->first();
        $breadcrumbs->parent('tourPackages.index',$tourOperator->uuid);
        $breadcrumbs->push(trans('Unapproved Tour Bookings'), route('tourPackageBookings.unApprovedTourPackageBookingsIndex',$tourPackageId));
    });
    Breadcrumbs::register('tourPackageBookings.deletedTourPackageBookingsIndex', function ($breadcrumbs,$tourPackageId) {
        $tourPackage=TourPackages::query()->where('uuid',$tourPackageId)->first();
        $tourOperator=tourOperator::query()->where('id',$tourPackage->tour_operator_id)->first();
        $breadcrumbs->parent('tourPackages.index',$tourOperator->uuid);
        $breadcrumbs->push(trans('Deleted Tour Bookings'), route('tourPackageBookings.deletedTourPackageBookingsIndex',$tourPackageId));
    });








