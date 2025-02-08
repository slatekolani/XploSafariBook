<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('customerSatisfactionCategory.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Customer Satisfaction Categories'), route('customerSatisfactionCategory.index'));
});

Breadcrumbs::register('customerSatisfactionCategory.create', function ($breadcrumbs) {
    $breadcrumbs->parent('customerSatisfactionCategory.index');
    $breadcrumbs->push(trans('Create'), route('customerSatisfactionCategory.create'));
});

Breadcrumbs::register('customerSatisfactionCategory.view', function ($breadcrumbs,$customerSatisfactionCategoryuuid) {
    $breadcrumbs->parent('customerSatisfactionCategory.index');
    $breadcrumbs->push(trans('View'), route('customerSatisfactionCategory.view',$customerSatisfactionCategoryuuid));
});

Breadcrumbs::register('customerSatisfactionCategory.edit', function ($breadcrumbs,$customerSatisfactionCategoryuuid) {
    $breadcrumbs->parent('customerSatisfactionCategory.index');
    $breadcrumbs->push(trans('Edit'), route('customerSatisfactionCategory.edit',$customerSatisfactionCategoryuuid));
});