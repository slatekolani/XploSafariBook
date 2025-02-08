<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('touristicGame.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Touristic Games'), route('touristicGame.index'));
});

Breadcrumbs::register('touristicGame.create', function ($breadcrumbs) {
    $breadcrumbs->parent('touristicGame.index');
    $breadcrumbs->push(trans('Create'), route('touristicGame.create'));
});

Breadcrumbs::register('touristicGame.view', function ($breadcrumbs,$touristicGameUuid) {
    $breadcrumbs->parent('touristicGame.index');
    $breadcrumbs->push(trans('View'), route('touristicGame.view',$touristicGameUuid));
});

Breadcrumbs::register('touristicGame.edit', function ($breadcrumbs,$touristicGameUuid) {
    $breadcrumbs->parent('touristicGame.index');
    $breadcrumbs->push(trans('Edit'), route('touristicGame.edit',$touristicGameUuid));
});