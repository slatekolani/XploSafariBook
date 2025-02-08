<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('event.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Events'), route('event.index'));
});

Breadcrumbs::register('event.create', function ($breadcrumbs) {
    $breadcrumbs->parent('event.index');
    $breadcrumbs->push(trans('Create'), route('event.create'));
});

Breadcrumbs::register('event.view', function ($breadcrumbs,$eventUuid) {
    $breadcrumbs->parent('event.index');
    $breadcrumbs->push(trans('View'), route('event.view',$eventUuid));
});

Breadcrumbs::register('event.edit', function ($breadcrumbs,$eventUuid) {
    $breadcrumbs->parent('event.index');
    $breadcrumbs->push(trans('Edit'), route('event.edit',$eventUuid));
});