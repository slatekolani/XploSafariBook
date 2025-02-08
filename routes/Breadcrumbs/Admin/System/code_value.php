<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 12/27/18
 * Time: 5:21 PM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('code.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.system_menu');
    $breadcrumbs->push(trans('label.administrator.system.codes.code'), route('code.index'));
});
//
Breadcrumbs::register('code.values', function ($breadcrumbs, $code) {
    $breadcrumbs->parent('code.index');
    $breadcrumbs->push(trans('label.administrator.system.code_values.code_values'), route('code.values',$code));
});
//
Breadcrumbs::register('code.value.create', function ($breadcrumbs, $code) {
    $breadcrumbs->parent('code.values',$code);
    $breadcrumbs->push(trans('label.crud.add'), route('code.value.create',$code));
});

Breadcrumbs::register('code.value.edit', function ($breadcrumbs, $code_value) {
    $cv = \App\Models\System\CodeValue::query()->find($code_value);
    $breadcrumbs->parent('code.values',$cv->code);
    $breadcrumbs->push(trans('label.crud.add'), route('code.value.edit',$code_value));
});