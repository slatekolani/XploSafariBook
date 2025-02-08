<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/11/19
 * Time: 3:55 PM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('workflow.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('label.administrator.system.workflow.settings'), route('workflow.index'));
});

Breadcrumbs::register('workflow.allocation', function ($breadcrumbs) {
    $breadcrumbs->parent('workflow.index');
    $breadcrumbs->push(trans('label.administrator.system.workflow.workflow_allocation'), route('workflow.allocation'));
});

Breadcrumbs::register('workflow.workflow_defaults', function ($breadcrumbs) {
    $breadcrumbs->parent('workflow.index');
    $breadcrumbs->push(trans('label.administrator.system.workflow.assign_workflow'), route('workflow.workflow_defaults'));
});

Breadcrumbs::register('workflow.pending', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('label.administrator.system.workflow.pendings'), route('workflow.pending'));
});