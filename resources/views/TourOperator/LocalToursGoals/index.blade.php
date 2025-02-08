@extends('layouts.main', ['title' => trans('Analytics - ' . $tourOperator->company_name), 'header' => trans('Analytics - ' . $tourOperator->company_name)])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')

    
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{ route('tourCompanyLocalToursGoals.create', $tourOperator->uuid) }}" style="color: white;padding: 10px 10px 10px 10px">Make Year Resolutions &blacktriangleright;</a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:100%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.LocalToursGoals.get_tour_company_local_tours_goals')
            </section>
        </div>

    </div>
@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
