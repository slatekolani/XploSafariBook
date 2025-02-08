<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('tourType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Tour Types'), route('tourType.index'));
});

Breadcrumbs::register('tourType.create', function ($breadcrumbs) {
    $breadcrumbs->parent('tourType.index');
    $breadcrumbs->push(trans('Create'), route('tourType.create'));
});

Breadcrumbs::register('tourType.edit', function ($breadcrumbs,$tourTypeUuid) {
    $breadcrumbs->parent('tourType.index');
    $breadcrumbs->push(trans('Edit'), route('tourType.edit',$tourTypeUuid));
});