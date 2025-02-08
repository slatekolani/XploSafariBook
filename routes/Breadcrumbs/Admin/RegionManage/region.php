<?php

use App\Models\tanzaniaRegions\regionCulture\tanzaniaRegionCulture;
use App\Models\tanzaniaRegions\tanzaniaRegionFAQ\tanzaniaRegionFAQ;
use App\Models\tanzaniaRegions\tanzaniaRegions;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('tanzaniaRegion.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Tanzania Regions'), route('tanzaniaRegion.index'));
});


Breadcrumbs::register('tanzaniaRegion.edit', function ($breadcrumbs,$tanzaniaRegion) {
    $breadcrumbs->parent('tanzaniaRegion.index');
    $breadcrumbs->push(trans('Edit'), route('tanzaniaRegion.edit',$tanzaniaRegion));
});

Breadcrumbs::register('tanzaniaRegion.create', function ($breadcrumbs) {
    $breadcrumbs->parent('tanzaniaRegion.index');
    $breadcrumbs->push(trans('Create'), route('tanzaniaRegion.create'));
});

Breadcrumbs::register('tanzaniaRegion.view', function ($breadcrumbs,$tanzaniaRegion) {
    $breadcrumbs->parent('tanzaniaRegion.index');
    $breadcrumbs->push(trans('View'), route('tanzaniaRegion.view',$tanzaniaRegion));
});

Breadcrumbs::register('regionCulture.index', function ($breadcrumbs,$tanzaniaRegion) {
    $breadcrumbs->parent('tanzaniaRegion.index');
    $breadcrumbs->push(trans('Cultures'), route('regionCulture.index',$tanzaniaRegion));
});

Breadcrumbs::register('tanzaniaRegionFAQ.index', function ($breadcrumbs,$tanzaniaRegion) {
    $breadcrumbs->parent('tanzaniaRegion.index');
    $breadcrumbs->push(trans('FAQ'), route('tanzaniaRegionFAQ.index',$tanzaniaRegion));
});

Breadcrumbs::register('tanzaniaRegionFAQ.create', function ($breadcrumbs,$tanzaniaRegion) {
    $breadcrumbs->parent('tanzaniaRegionFAQ.index',$tanzaniaRegion);
    $breadcrumbs->push(trans('Create'), route('tanzaniaRegionFAQ.create',$tanzaniaRegion));
});

Breadcrumbs::register('tanzaniaRegionFAQ.view', function ($breadcrumbs,$tanzaniaRegionFAQUuid) {
    $tanzaniaRegionFAQ=tanzaniaRegionFAQ::query()->where('uuid',$tanzaniaRegionFAQUuid)->first();
    $tanzaniaRegion=tanzaniaRegions::query()->where('id',$tanzaniaRegionFAQ->tanzania_region_id)->first();
    $breadcrumbs->parent('tanzaniaRegionFAQ.index',$tanzaniaRegion->uuid);
    $breadcrumbs->push(trans('View'), route('tanzaniaRegionFAQ.view',$tanzaniaRegionFAQUuid));
});

Breadcrumbs::register('tanzaniaRegionFAQ.edit', function ($breadcrumbs,$tanzaniaRegionFAQUuid) {
    $tanzaniaRegionFAQ=tanzaniaRegionFAQ::query()->where('uuid',$tanzaniaRegionFAQUuid)->first();
    $tanzaniaRegion=tanzaniaRegions::query()->where('id',$tanzaniaRegionFAQ->tanzania_region_id)->first();
    $breadcrumbs->parent('tanzaniaRegionFAQ.index',$tanzaniaRegion->uuid);
    $breadcrumbs->push(trans('Edit'), route('tanzaniaRegionFAQ.edit',$tanzaniaRegionFAQUuid));
});

Breadcrumbs::register('regionCulture.cultureCreate', function ($breadcrumbs,$tanzaniaRegion) {
    $breadcrumbs->parent('regionCulture.index',$tanzaniaRegion);
    $breadcrumbs->push(trans('Create Culture'), route('regionCulture.cultureCreate',$tanzaniaRegion));
});

Breadcrumbs::register('regionCulture.view', function ($breadcrumbs, $regionCulture) {
    $regionCultureData=tanzaniaRegionCulture::query()->where('uuid',$regionCulture)->first();
    $tanzaniaRegion=tanzaniaRegions::query()->where('id',$regionCultureData->tanzania_region_id)->first();
    $breadcrumbs->parent('regionCulture.index', $tanzaniaRegion->uuid);
    $breadcrumbs->push(trans('View Culture'), route('regionCulture.view', $regionCulture));
});

Breadcrumbs::register('regionCulture.edit', function ($breadcrumbs, $regionCulture) {
    $regionCultureData=tanzaniaRegionCulture::query()->where('uuid',$regionCulture)->first();
    $tanzaniaRegion=tanzaniaRegions::query()->where('id',$regionCultureData->tanzania_region_id)->first();
    $breadcrumbs->parent('regionCulture.index',$tanzaniaRegion->uuid);
    $breadcrumbs->push(trans('Edit Culture'), route('regionCulture.edit', $regionCulture));
});