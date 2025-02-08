<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('specialNeed.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Special Need'), route('specialNeed.index'));
});

Breadcrumbs::register('specialNeed.create', function ($breadcrumbs) {
    $breadcrumbs->parent('specialNeed.index');
    $breadcrumbs->push(trans('Create'), route('specialNeed.create'));
});

Breadcrumbs::register('specialNeed.edit', function ($breadcrumbs,$specialNeedUuid) {
    $breadcrumbs->parent('specialNeed.index');
    $breadcrumbs->push(trans('Edit'), route('specialNeed.edit',$specialNeedUuid));
});