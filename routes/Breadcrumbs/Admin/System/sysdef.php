<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 12/27/18
 * Time: 5:30 PM
 */

Breadcrumbs::register('sysdef.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.system_menu');
    $breadcrumbs->push(trans('label.administrator.system.sysdef.sysdef'), route('sysdef.index'));
});
//
Breadcrumbs::register('sysdef.definitions', function ($breadcrumbs,$sysdef_group) {
    $breadcrumbs->parent('sysdef.index');
    $breadcrumbs->push(trans('label.administrator.system.sysdef.definitions'), route('sysdef.definitions',$sysdef_group));
});
//
Breadcrumbs::register('sysdef.edit', function ($breadcrumbs, $sysdef) {
    $breadcrumbs->parent('sysdef.definitions',$sysdef->sysdefGroup->id);
    $breadcrumbs->push(trans('label.crud.edit'), route('sysdef.edit',$sysdef));
});
////
