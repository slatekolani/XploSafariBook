<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/11/19
 * Time: 5:10 PM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('user.profile', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('label.profile'), route('user.profile', $user));
});
//

Breadcrumbs::register('user.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('user.profile', $user);
    $breadcrumbs->push(trans('label.crud.edit'), route('user.edit', $user));
});

//