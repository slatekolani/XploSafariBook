<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('transport.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Transports'), route('transport.index'));
});

Breadcrumbs::register('transport.create', function ($breadcrumbs) {
    $breadcrumbs->parent('transport.index');
    $breadcrumbs->push(trans('Create'), route('transport.create'));
});

Breadcrumbs::register('transport.edit', function ($breadcrumbs,$transportUuid) {
    $breadcrumbs->parent('transport.index');
    $breadcrumbs->push(trans('Edit'), route('transport.edit',$transportUuid));
});