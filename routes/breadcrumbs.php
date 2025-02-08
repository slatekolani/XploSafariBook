<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home breadcrumb
Breadcrumbs::for('home', function ($trail) {
    $trail->push(trans('label.home'), route('home'));
});

includeRouteFiles(__DIR__.'/Breadcrumbs/');
