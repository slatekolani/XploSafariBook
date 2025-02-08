<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/11/19
 * Time: 5:10 PM
 */

Breadcrumbs::register('admin.user_manage.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('label.administrator.users.manage_users'), route('admin.user_manage.index'));
});
//

Breadcrumbs::register('admin.user_manage.system_users', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.user_manage.index');
    $breadcrumbs->push(trans('label.administrator.users.system_users'), route('admin.user_manage.system_users'));
});


Breadcrumbs::register('admin.user_manage.create_system_user', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.user_manage.system_users');
    $breadcrumbs->push(trans('label.crud.add'), route('admin.user_manage.create_system_user'));
});

Breadcrumbs::register('admin.user_manage.edit_system_user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.user_manage.system_users');
    $breadcrumbs->push(trans('label.crud.edit'), route('admin.user_manage.edit_system_user',$user));
});

Breadcrumbs::register('admin.nation.index', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.nation.index');
    $breadcrumbs->push(trans('Nations'), route('admin.nation.index',$user));
});