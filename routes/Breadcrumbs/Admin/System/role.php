<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 1/8/19
 * Time: 10:37 AM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('access.role.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.system_menu');
    $breadcrumbs->push(trans('label.administrator.system.access_control.roles_permissions'), route('access.role.index'));
});
//
Breadcrumbs::register('access.role.create', function ($breadcrumbs) {
    $breadcrumbs->parent('access.role.index');
    $breadcrumbs->push(trans('label.crud.add'), route('access.role.create'));
});

Breadcrumbs::register('access.role.edit', function ($breadcrumbs, $role) {
    $breadcrumbs->parent('access.role.index');
    $breadcrumbs->push(trans('label.crud.edit'), route('access.role.edit', $role->id));
});