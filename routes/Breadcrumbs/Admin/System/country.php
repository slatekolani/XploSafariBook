<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 1/8/19
 * Time: 10:37 AM
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('country.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.system_menu');
    $breadcrumbs->push(trans('label.country'), route('country.index'));
});

Breadcrumbs::register('country.create', function ($breadcrumbs) {
    $breadcrumbs->parent('country.index');
    $breadcrumbs->push(trans('label.crud.add'), route('country.create'));
});
//
Breadcrumbs::register('country.edit', function ($breadcrumbs,$country) {
    $breadcrumbs->parent('country.index');
    $breadcrumbs->push(trans('label.crud.edit'), route('country.edit',$country));
});

Breadcrumbs::register('country.profile', function ($breadcrumbs,$country) {
    $breadcrumbs->parent('country.index');
    $breadcrumbs->push(trans('label.profile'), route('country.profile',$country));
});
//
Breadcrumbs::register('country.create_region', function ($breadcrumbs,$country) {
//    $countries = new \App\Repositories\Sysdef\CountryRepository();
    $county =\App\Models\System\Country::find($country);
    $breadcrumbs->parent('country.profile',$county->code);
    $breadcrumbs->push(trans('label.administrator.system.country.create_region'), route('country.create_region',$country));
});
//
Breadcrumbs::register('country.edit_region', function ($breadcrumbs,$region) {
    $regions = new \App\Repositories\System\RegionRepository();
    $region = $regions->getRegionByCode($region);
    $county =\App\Models\System\Country::find($region->country_id);
    $breadcrumbs->parent('country.profile',$county->code);
    $breadcrumbs->push(trans('label.administrator.system.country.edit_region'), route('country.edit_region',$region));
});