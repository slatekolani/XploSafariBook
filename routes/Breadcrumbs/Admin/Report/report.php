<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/11/19
 * Time: 3:55 PM
 */

Breadcrumbs::register('admin.report.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('label.administrator.system.reports.report_groups'), route('admin.report.index'));
});

Breadcrumbs::register('admin.report.reports_by_group', function ($breadcrumbs,$report_group) {
    $breadcrumbs->parent('admin.report.index');
    $breadcrumbs->push(trans('label.administrator.system.reports.reports'), route('admin.report.reports_by_group', $report_group));
});