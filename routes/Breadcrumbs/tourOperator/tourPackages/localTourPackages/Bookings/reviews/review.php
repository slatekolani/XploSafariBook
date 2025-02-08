<?php

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;



Breadcrumbs::register('localTouristReview.index', function ($breadcrumbs,$localTourBookingUuid) {
    $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
    $localTourPackage=localTourPackages::query()->where('id',$localTourBooking->local_tour_package_id)->first();
    $breadcrumbs->parent('localTourBooking.index',$localTourPackage->uuid);    
    $breadcrumbs->push(trans('Trip Reviews'), route('localTouristReview.index',$localTourBookingUuid));
});
Breadcrumbs::register('localTouristReview.approvedLocalTouristReviewsIndex', function ($breadcrumbs,$localTourBookingUuid) {
    $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
    $localTourPackage=localTourPackages::query()->where('id',$localTourBooking->local_tour_package_id)->first();
    $breadcrumbs->parent('localTourBooking.index',$localTourPackage->uuid);    
    $breadcrumbs->push(trans('Approved Reviews'), route('localTouristReview.approvedLocalTouristReviewsIndex',$localTourBookingUuid));
});

Breadcrumbs::register('localTouristReview.unApprovedTouristReviewIndex', function ($breadcrumbs,$localTourBookingUuid) {
    $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
    $localTourPackage=localTourPackages::query()->where('id',$localTourBooking->local_tour_package_id)->first();
    $breadcrumbs->parent('localTourBooking.index',$localTourPackage->uuid);    
    $breadcrumbs->push(trans('Unapproved Reviews'), route('localTouristReview.unApprovedTouristReviewIndex',$localTourBookingUuid));
});

Breadcrumbs::register('localTouristReview.deletedTouristReviewIndex', function ($breadcrumbs,$localTourBookingUuid) {
    $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
    $localTourPackage=localTourPackages::query()->where('id',$localTourBooking->local_tour_package_id)->first();
    $breadcrumbs->parent('localTourBooking.index',$localTourPackage->uuid);    
    $breadcrumbs->push(trans('Deleted Reviews'), route('localTouristReview.deletedTouristReviewIndex',$localTourBookingUuid));
});