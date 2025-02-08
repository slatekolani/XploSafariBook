<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('tourPackageType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Tour Package Type'), route('tourPackageType.index'));
});

Breadcrumbs::register('tourPackageType.create', function ($breadcrumbs) {
    $breadcrumbs->parent('tourPackageType.index');
    $breadcrumbs->push(trans('Create'), route('tourPackageType.create'));
});

Breadcrumbs::register('tourPackageType.view', function ($breadcrumbs,$tourPackageTypeUuid) {
    $breadcrumbs->parent('tourPackageType.index');
    $breadcrumbs->push(trans('View'), route('tourPackageType.view',$tourPackageTypeUuid));
});

Breadcrumbs::register('tourPackageType.edit', function ($breadcrumbs,$tourPackageTypeUuid) {
    $breadcrumbs->parent('tourPackageType.index');
    $breadcrumbs->push(trans('Edit'), route('tourPackageType.edit',$tourPackageTypeUuid));
});