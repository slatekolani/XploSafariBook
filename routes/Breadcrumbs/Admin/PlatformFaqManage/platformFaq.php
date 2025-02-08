<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('platformFaq.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Platform Faq'), route('platformFaq.index'));
});

Breadcrumbs::register('platformFaq.create', function ($breadcrumbs) {
    $breadcrumbs->parent('platformFaq.index');
    $breadcrumbs->push(trans('Create'), route('platformFaq.create'));
});

Breadcrumbs::register('platformFaq.edit', function ($breadcrumbs,$platformFaqUuid) {
    $breadcrumbs->parent('platformFaq.index');
    $breadcrumbs->push(trans('Edit'), route('platformFaq.edit',$platformFaqUuid));
});