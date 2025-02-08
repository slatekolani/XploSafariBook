<?php

use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\LocalTourPackages\localTourPackages;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;



Breadcrumbs::register('localTourPackages.index', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('tourOperator.index');
    $breadcrumbs->push(trans('Local Tour Packages'), route('localTourPackages.index',$tourOperatorUuid));
});

Breadcrumbs::register('localTourPackages.create', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('localTourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Create Local Tour Packages'), route('localTourPackages.create',$tourOperatorUuid));
});


Breadcrumbs::register('localTourPackages.recentLocalPackagesIndex', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('localTourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Recent Posted Local T.P'), route('localTourPackages.recentLocalPackagesIndex',$tourOperatorUuid));
});

Breadcrumbs::register('localTourPackages.verifiedLocalPackagesIndex', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('localTourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Verified Local T.P'), route('localTourPackages.verifiedLocalPackagesIndex',$tourOperatorUuid));
});

Breadcrumbs::register('localTourPackages.unverifiedLocalPackagesIndex', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('localTourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Unverified Local T.P'), route('localTourPackages.unverifiedLocalPackagesIndex',$tourOperatorUuid));
});
Breadcrumbs::register('localTourPackages.nearLocalToursIndex', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('localTourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Near Local T.P'), route('localTourPackages.nearLocalToursIndex',$tourOperatorUuid));
});
Breadcrumbs::register('localTourPackages.expiredLocalToursIndex', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('localTourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Expired Local T.P'), route('localTourPackages.expiredLocalToursIndex',$tourOperatorUuid));
});
Breadcrumbs::register('localTourPackages.deletedLocalToursIndex', function ($breadcrumbs,$tourOperatorUuid) {
    $breadcrumbs->parent('localTourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Deleted Local T.P'), route('localTourPackages.deletedLocalToursIndex',$tourOperatorUuid));
});


// view

Breadcrumbs::register('localTourPackages.edit', function ($breadcrumbs,$localTourPackageUuid) {
    $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
    $tourOperator=tourOperator::query()->where('id',$localTourPackage->tour_operator_id)->first();
    $breadcrumbs->parent('localTourPackages.index',$tourOperator->uuid);
    $breadcrumbs->push(trans('Edit Local T.P'), route('localTourPackages.edit',$localTourPackageUuid));
});

Breadcrumbs::register('localTourPackages.show', function ($breadcrumbs,$localTourPackageUuid) {
    dd(12);
    $localTourPackage=localTourPackages::query()->where('uuid',$localTourPackageUuid)->first();
    $tourOperator=tourOperator::query()->where('id',$localTourPackage->tour_operator_id)->first();
    $breadcrumbs->parent('localTourPackages.index',$tourOperator->uuid);
    $breadcrumbs->push(trans('View Local T.P'), route('localTourPackages.show',$localTourPackageUuid));
});

