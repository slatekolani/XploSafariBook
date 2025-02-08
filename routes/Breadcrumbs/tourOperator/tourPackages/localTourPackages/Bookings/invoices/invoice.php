<?php

use App\Models\TourOperator\TourPackages\LocalTourPackages\LocalTourPackageBookings\localTourPackageBookings;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;



Breadcrumbs::register('localTourBooking.previewInvoice', function ($breadcrumbs,$localTourBookingUuid) {
    $localTourBooking=localTourPackageBookings::query()->where('uuid',$localTourBookingUuid)->first();
    $localTourPackage=localTourPackages::query()->where('id',$localTourBooking->local_tour_package_id)->first();
    $breadcrumbs->parent('localTourBooking.index',$localTourPackage->uuid);    
    $breadcrumbs->push(trans('Trip Invoice'), route('localTourBooking.previewInvoice',$localTourBookingUuid));
});