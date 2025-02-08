@extends('layouts.main', ['title' => trans('Manage tour package types'), 'header' => trans('Manage tour package types')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div id="notify" style="display: none"></div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" >
            <div class="pull-left" >
                <a class ='btn btn-primary'  href="{{ route('tourPackageType.create') }}" style="margin-bottom: 10px"> Add Tour Package Type &blacktriangleright;</a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:130%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('tourPackageType.getTourPackageTypes')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
