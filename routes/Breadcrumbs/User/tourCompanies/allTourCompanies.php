<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('tourOperator.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Tour Companies'), route('tourOperator.index'));
});
Breadcrumbs::register('tourOperator.show', function ($breadcrumbs,$tourCompanyUuid) {
    $breadcrumbs->parent('tourOperator.index',$tourCompanyUuid);
    $breadcrumbs->push(trans('View Tour Company'), route('tourOperator.show',$tourCompanyUuid));
});
Breadcrumbs::register('tourOperator.edit', function ($breadcrumbs,$tourCompanyUuid) {
    $breadcrumbs->parent('tourOperator.show',$tourCompanyUuid);
    $breadcrumbs->push(trans('Edit Tour Company'), route('tourOperator.edit',$tourCompanyUuid));
});




