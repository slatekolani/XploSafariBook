@extends('layouts.error', ['title' => trans('http.429.title')])

@section('content')

    <div class="main-error mb-3">
        <h2 class="error-code text-dark text-center font-weight-semibold m-0">@lang('http.429.code') <i class="fas fa-file"></i></h2>
        <p class="error-explanation text-center">@lang('http.429.title')</p>
        <p class="error-explanation text-center">@lang('http.429.description')</p>
    </div>

@stop
