<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('touristicAttractionCategory.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Attraction Categories'), route('touristicAttractionCategory.index'));
});

Breadcrumbs::register('touristicAttractionCategory.create', function ($breadcrumbs) {
    $breadcrumbs->parent('touristicAttractionCategory.index');
    $breadcrumbs->push(trans('Create'), route('touristicAttractionCategory.create'));
});

Breadcrumbs::register('touristicAttractionCategory.view', function ($breadcrumbs,$attractionCategoryUuid) {
    $breadcrumbs->parent('touristicAttractionCategory.index',$attractionCategoryUuid);
    $breadcrumbs->push(trans('View'), route('touristicAttractionCategory.view',$attractionCategoryUuid));
});
Breadcrumbs::register('touristicAttractionCategory.edit', function ($breadcrumbs,$attractionCategoryUuid) {
    $breadcrumbs->parent('touristicAttractionCategory.index',$attractionCategoryUuid);
    $breadcrumbs->push(trans('Edit'), route('touristicAttractionCategory.edit',$attractionCategoryUuid));
});
