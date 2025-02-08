<?php

use App\Models\aboutTanzania\FAQ\tanzaniaFAQ;
use App\Models\aboutTanzania\tanzaniaVisitAdvice\tanzaniaVisitAdvice;
use App\Models\Nations\nations;
use App\Models\TouristicAttractions\touristicAttractionRules\touristicAttractionRules;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::register('nation.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('Nations'), route('nation.index'));
});


Breadcrumbs::register('nation.create', function ($breadcrumbs) {
    $breadcrumbs->parent('nation.index');
    $breadcrumbs->push(trans('Create'), route('nation.create'));
});

Breadcrumbs::register('nation.edit', function ($breadcrumbs ,$nation) {
    $breadcrumbs->parent('nation.index');
    $breadcrumbs->push(trans('Edit'), route('nation.edit',$nation));
});


// Nation FAQ
Breadcrumbs::register('tanzaniaFAQ.index', function ($breadcrumbs ,$nation) {
    $breadcrumbs->parent('nation.index');
    $breadcrumbs->push(trans('FAQ'), route('tanzaniaFAQ.index',$nation));
});

Breadcrumbs::register('tanzaniaFAQ.create', function ($breadcrumbs ,$nation) {
    $breadcrumbs->parent('tanzaniaFAQ.index',$nation);
    $breadcrumbs->push(trans('Create'), route('tanzaniaFAQ.create',$nation));
});

Breadcrumbs::register('tanzaniaFAQ.show', function ($breadcrumbs ,$tanzaniaFAQUuid) {
    $tanzaniaFAQ=tanzaniaFAQ::query()->where('uuid',$tanzaniaFAQUuid)->first();
    $nation=nations::query()->where('id',$tanzaniaFAQ->id)->first();
    $breadcrumbs->parent('tanzaniaFAQ.index',$nation->uuid);
    $breadcrumbs->push(trans('View'), route('tanzaniaFAQ.show',$nation));
});

Breadcrumbs::register('tanzaniaFAQ.edit', function ($breadcrumbs ,$tanzaniaFAQUuid) {
    $tanzaniaFAQ=tanzaniaFAQ::query()->where('uuid',$tanzaniaFAQUuid)->first();
    $nation=nations::query()->where('id',$tanzaniaFAQ->id)->first();
    $breadcrumbs->parent('tanzaniaFAQ.index',$nation->uuid);
    $breadcrumbs->push(trans('Edit'), route('tanzaniaFAQ.edit',$nation));
});


// Visit Advices
Breadcrumbs::register('tanzaniaVisitAdvice.index', function ($breadcrumbs ,$nation) {
    $breadcrumbs->parent('nation.index');
    $breadcrumbs->push(trans('Visit Advice'), route('tanzaniaVisitAdvice.index',$nation));
});

Breadcrumbs::register('tanzaniaVisitAdvice.create', function ($breadcrumbs ,$nation) {
    $breadcrumbs->parent('tanzaniaVisitAdvice.index',$nation);
    $breadcrumbs->push(trans('Create'), route('tanzaniaVisitAdvice.create',$nation));
});

Breadcrumbs::register('tanzaniaVisitAdvice.show', function ($breadcrumbs ,$tanzaniaVisitAdviceUuid) {
    $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('uuid',$tanzaniaVisitAdviceUuid)->first();
    $nation=nations::query()->where('id',$tanzaniaVisitAdvice->nation_id)->first();
    $breadcrumbs->parent('tanzaniaVisitAdvice.index',$nation->uuid);
    $breadcrumbs->push(trans('View'), route('tanzaniaVisitAdvice.show',$tanzaniaVisitAdvice));
});

Breadcrumbs::register('tanzaniaVisitAdvice.edit', function ($breadcrumbs ,$tanzaniaVisitAdviceUuid) {
    $tanzaniaVisitAdvice=tanzaniaVisitAdvice::query()->where('uuid',$tanzaniaVisitAdviceUuid)->first();
    $nation=nations::query()->where('id',$tanzaniaVisitAdvice->nation_id)->first();
    $breadcrumbs->parent('tanzaniaVisitAdvice.index',$nation->uuid);
    $breadcrumbs->push(trans('Edit'), route('tanzaniaVisitAdvice.edit',$tanzaniaVisitAdvice));
});

// Attraction rules

Breadcrumbs::register('touristicAttractionRule.index', function ($breadcrumbs ,$nation) {
    $breadcrumbs->parent('nation.index');
    $breadcrumbs->push(trans('Attraction Rules'), route('touristicAttractionRule.index',$nation));
});

Breadcrumbs::register('touristicAttractionRule.create', function ($breadcrumbs ,$nation) {
    $breadcrumbs->parent('touristicAttractionRule.index',$nation);
    $breadcrumbs->push(trans('Create'), route('touristicAttractionRule.create',$nation));
});

Breadcrumbs::register('touristicAttractionRule.view', function ($breadcrumbs ,$touristicAttractionUuid) {
    $touristicAttractionRule=touristicAttractionRules::query()->where('uuid',$touristicAttractionUuid)->first();
    $nation=nations::query()->where('id',$touristicAttractionRule->nation_id)->first();
    $breadcrumbs->parent('touristicAttractionRule.index',$nation->uuid);
    $breadcrumbs->push(trans('View'), route('touristicAttractionRule.view',$touristicAttractionUuid));
});

Breadcrumbs::register('touristicAttractionRule.edit', function ($breadcrumbs ,$touristicAttractionUuid) {
    $touristicAttractionRule=touristicAttractionRules::query()->where('uuid',$touristicAttractionUuid)->first();
    $nation=nations::query()->where('id',$touristicAttractionRule->nation_id)->first();
    $breadcrumbs->parent('touristicAttractionRule.index',$nation->uuid);
    $breadcrumbs->push(trans('Edit'), route('touristicAttractionRule.edit',$touristicAttractionUuid));
});