<?php

use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\InternationalTourPackages\TourPackages;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

if (auth()->check() && auth()->user()->role == 1) 
    {

    Breadcrumbs::register('tourPackages.index', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('International Tour Packages'), route('tourPackages.index',$tour_operator_id));
    });

    Breadcrumbs::register('tourPackages.companyInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('International Tour Packages'), route('tourPackages.companyInternationalTourPackagesIndex',$tour_operator_id));
    });

    Breadcrumbs::register('tourPackages.recentInternationalPostedTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('Recent Posted International T.P'), route('tourPackages.recentInternationalPostedTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.verifiedInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('Verified International T.P'), route('tourPackages.verifiedInternationalTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.unverifiedInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('Unverified International T.P'), route('tourPackages.unverifiedInternationalTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.nearInternationalToursToBeConductedIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('Near International Safaris'), route('tourPackages.nearInternationalToursToBeConductedIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.expiredInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('Expired International T.P'), route('tourPackages.expiredInternationalTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.deletedInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
        $breadcrumbs->push(trans('Deleted International T.P'), route('tourPackages.deletedInternationalTourPackagesIndex',$tour_operator_id));
    });
}


else if(auth()->check() && auth()->user()->role == 2)
{

    Breadcrumbs::register('tourPackages.index', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('International Tour Packages'), route('tourPackages.index',$tour_operator_id));
    });

    Breadcrumbs::register('tourPackages.companyInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('International Tour Packages'), route('tourPackages.companyInternationalTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.recentInternationalPostedTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('Recent Posted International T.P'), route('tourPackages.recentInternationalPostedTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.verifiedInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('Verified International T.P'), route('tourPackages.verifiedInternationalTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.unverifiedInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('Unverified International T.P'), route('tourPackages.unverifiedInternationalTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.nearInternationalToursToBeConductedIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('Near International Safaris'), route('tourPackages.nearInternationalToursToBeConductedIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.expiredInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('Expired International T.P'), route('tourPackages.expiredInternationalTourPackagesIndex',$tour_operator_id));
    });
    Breadcrumbs::register('tourPackages.deletedInternationalTourPackagesIndex', function ($breadcrumbs,$tour_operator_id) {
        $breadcrumbs->parent('tourOperator.index');
        $breadcrumbs->push(trans('Deleted International T.P'), route('tourPackages.deletedInternationalTourPackagesIndex',$tour_operator_id));
    });


}

Breadcrumbs::register('tourPackages.show', function ($breadcrumbs, $tour_package) { 
    $tourPackage=TourPackages::query()->where('uuid',$tour_package)->first();
    $tourOperator=tourOperator::query()->where('id',$tourPackage->tour_operator_id)->first();
    $tourOperatorUuid=$tourOperator->uuid;
    $breadcrumbs->parent('tourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('View Tour Package'), route('tourPackages.show', $tour_package));
});

Breadcrumbs::register('tourPackages.edit', function ($breadcrumbs, $tour_package) { 
    $tourPackage=TourPackages::query()->where('uuid',$tour_package)->first();
    $tourOperator=tourOperator::query()->where('id',$tourPackage->tour_operator_id)->first();
    $tourOperatorUuid=$tourOperator->uuid;
    $breadcrumbs->parent('tourPackages.index',$tourOperatorUuid);
    $breadcrumbs->push(trans('Edit Tour Package'), route('tourPackages.edit', $tour_package));
});








