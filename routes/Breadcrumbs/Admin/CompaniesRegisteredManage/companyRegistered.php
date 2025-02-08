<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('tourOperatorCompaniesManagement.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Companies Registered'), route('tourOperatorCompaniesManagement.index'));
});

Breadcrumbs::register('tourOperatorCompaniesManagement.verifiedTourOperatorsCompaniesIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
    $breadcrumbs->push(trans('Verified Companies'), route('tourOperatorCompaniesManagement.verifiedTourOperatorsCompaniesIndex'));
});

Breadcrumbs::register('tourOperatorCompaniesManagement.unverifiedTourOperatorsCompaniesIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
    $breadcrumbs->push(trans('Un-Verified Companies'), route('tourOperatorCompaniesManagement.unverifiedTourOperatorsCompaniesIndex'));
});

Breadcrumbs::register('tourOperatorCompaniesManagement.deletedTourCompaniesIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('tourOperatorCompaniesManagement.index');
    $breadcrumbs->push(trans('Deleted Companies'), route('tourOperatorCompaniesManagement.deletedTourCompaniesIndex'));
});