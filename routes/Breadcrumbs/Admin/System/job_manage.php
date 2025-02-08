<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/29/19
 * Time: 1:18 PM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('system.manage_jobs', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('label.administrator.system.jobs.manage_jobs'), route('system.manage_jobs'));
});
//

Breadcrumbs::register('system.job.index', function ($breadcrumbs) {
    $breadcrumbs->parent('system.manage_jobs');
    $breadcrumbs->push(trans('label.administrator.system.jobs.pending_jobs'), route('system.job.index'));
});


Breadcrumbs::register('system.failed_job.index', function ($breadcrumbs) {
    $breadcrumbs->parent('system.manage_jobs');
    $breadcrumbs->push(trans('label.administrator.system.jobs.failed_jobs'), route('system.failed_job.index'));
});


Breadcrumbs::register('system.job.show', function ($breadcrumbs, $job) {
    $breadcrumbs->parent('system.job.index');
    $breadcrumbs->push(trans('label.administrator.system.jobs.job'), route('system.job.show',$job));
});

Breadcrumbs::register('system.failed_job.show', function ($breadcrumbs, $failed_job) {
    $breadcrumbs->parent('system.failed_job.index');
    $breadcrumbs->push(trans('label.administrator.system.jobs.failed_job'), route('system.failed_job.show', $failed_job));
});