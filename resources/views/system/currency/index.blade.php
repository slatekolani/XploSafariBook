@extends('layouts.main', ['title' => __("label.currency"), 'header' => __("label.currency")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')

    <div class="row">



        <div class="col">
        @include('system.currency.includes.currencies')
        </div>

    </div>

@endsection