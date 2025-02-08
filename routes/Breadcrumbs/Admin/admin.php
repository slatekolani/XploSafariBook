<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/11/19
 * Time: 3:55 PM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('admin.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('label.administrator.admin_center'), route('admin.index'));
});