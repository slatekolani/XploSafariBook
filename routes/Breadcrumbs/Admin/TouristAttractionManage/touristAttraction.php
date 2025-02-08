<?php

use App\Models\TouristicAttractions\touristAttractionFaq;
use App\Models\TouristicAttractions\touristicAttractionHoneyPoint\touristicAttractionHoneyPoints;
use App\Models\TouristicAttractions\touristicAttractions;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('touristicAttraction.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Tourist Attractions'), route('touristicAttraction.index'));
});

Breadcrumbs::register('touristicAttraction.create', function ($breadcrumbs) {
    $breadcrumbs->parent('touristicAttraction.index');
    $breadcrumbs->push(trans('Create'), route('touristicAttraction.create'));
});

Breadcrumbs::register('touristicAttraction.edit', function ($breadcrumbs,$touristicAttractionUuid) {
    $breadcrumbs->parent('touristicAttraction.index');
    $breadcrumbs->push(trans('Edit'), route('touristicAttraction.edit',$touristicAttractionUuid));
});

// Honey Points
Breadcrumbs::register('touristicAttractionHoneyPoint.index', function ($breadcrumbs,$touristicAttractionUuid) {
    $breadcrumbs->parent('touristicAttraction.index');
    $breadcrumbs->push(trans('Honey Points'), route('touristicAttractionHoneyPoint.index',$touristicAttractionUuid));
});

Breadcrumbs::register('touristicAttractionHoneyPoint.create', function ($breadcrumbs,$touristicAttractionUuid) {
    $breadcrumbs->parent('touristicAttractionHoneyPoint.index',$touristicAttractionUuid);
    $breadcrumbs->push(trans('Create'), route('touristicAttractionHoneyPoint.index',$touristicAttractionUuid));
});

Breadcrumbs::register('touristicAttractionHoneyPoint.view', function ($breadcrumbs,$honeyPointUuid) {
    $honeyPoint=touristicAttractionHoneyPoints::query()->where('uuid',$honeyPointUuid)->first();
    $touristicAttraction=touristicAttractions::query()->where('id',$honeyPoint->touristic_attraction_id)->first();
    $breadcrumbs->parent('touristicAttractionHoneyPoint.index',$touristicAttraction->uuid);
    $breadcrumbs->push(trans('View'), route('touristicAttractionHoneyPoint.view',$honeyPointUuid));
});

Breadcrumbs::register('touristicAttractionHoneyPoint.edit', function ($breadcrumbs,$honeyPointUuid) {
    $honeyPoint=touristicAttractionHoneyPoints::query()->where('uuid',$honeyPointUuid)->first();
    $touristicAttraction=touristicAttractions::query()->where('id',$honeyPoint->touristic_attraction_id)->first();
    $breadcrumbs->parent('touristicAttractionHoneyPoint.index',$touristicAttraction->uuid);
    $breadcrumbs->push(trans('Edit'), route('touristicAttractionHoneyPoint.edit',$honeyPointUuid));
});

// Attraction FAQ
Breadcrumbs::register('touristicAttraction.touristAttractionFAQIndex', function ($breadcrumbs,$touristicAttractionUuid) {
    $breadcrumbs->parent('touristicAttraction.index');
    $breadcrumbs->push(trans('FAQ'), route('touristicAttraction.touristAttractionFAQIndex',$touristicAttractionUuid));
});

Breadcrumbs::register('touristicAttraction.touristAttractionFAQ', function ($breadcrumbs,$touristicAttractionUuid) {
    $breadcrumbs->parent('touristicAttraction.touristAttractionFAQIndex',$touristicAttractionUuid);
    $breadcrumbs->push(trans('Create'), route('touristicAttraction.touristAttractionFAQ',$touristicAttractionUuid));
});

Breadcrumbs::register('touristicAttraction.editTouristAttractionFAQ', function ($breadcrumbs,$touristAttractionFaqUuid) {
    $touristAttractionFaq=touristAttractionFaq::query()->where('uuid',$touristAttractionFaqUuid)->first();
    $touristAttraction=touristicAttractions::query()->where('id',$touristAttractionFaq->touristic_attraction_id)->first();
    $breadcrumbs->parent('touristicAttraction.touristAttractionFAQIndex',$touristAttraction->uuid);
    $breadcrumbs->push(trans('Edit'), route('touristicAttraction.editTouristAttractionFAQ',$touristAttractionFaq));
});