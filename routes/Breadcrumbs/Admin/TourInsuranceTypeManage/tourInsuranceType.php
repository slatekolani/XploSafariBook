<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('tourInsuranceType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Tour Insurance Type'), route('tourInsuranceType.index'));
});

Breadcrumbs::register('tourInsuranceType.create', function ($breadcrumbs) {
    $breadcrumbs->parent('tourInsuranceType.index');
    $breadcrumbs->push(trans('Create'), route('tourInsuranceType.create'));
});

Breadcrumbs::register('tourInsuranceType.view', function ($breadcrumbs,$tourInsuranceTypeUuid) {
    $breadcrumbs->parent('tourInsuranceType.index');
    $breadcrumbs->push(trans('View'), route('tourInsuranceType.view',$tourInsuranceTypeUuid));
});

Breadcrumbs::register('tourInsuranceType.edit', function ($breadcrumbs,$tourInsuranceTypeUuid) {
    $breadcrumbs->parent('tourInsuranceType.index');
    $breadcrumbs->push(trans('Edit'), route('tourInsuranceType.edit',$tourInsuranceTypeUuid));
});