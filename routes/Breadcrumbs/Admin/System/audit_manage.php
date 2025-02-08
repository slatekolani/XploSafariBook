<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/29/19
 * Time: 1:18 PM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//Breadcrumbs::register('system.audit.index', function ($breadcrumbs) {
//    $breadcrumbs->parent('admin.system_menu');
//    $breadcrumbs->push(trans('label.administrator.system.audits.manage_audits'), route('system.audit.index'));
//});
////

Breadcrumbs::register('system.audit.search_page', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.system_menu');
    $breadcrumbs->push(trans('label.administrator.system.audits.search_audits'), route('system.audit.search_page'));
});


Breadcrumbs::register('system.audit.show', function ($breadcrumbs, $audit) {
    $breadcrumbs->parent('system.audit.search_page');
    $breadcrumbs->push(trans('label.administrator.system.audits.audit'), route('system.audit.show', $audit));
});


