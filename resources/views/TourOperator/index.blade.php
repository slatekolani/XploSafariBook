@extends('layouts.main', ['title' => trans('Tour Companies'), 'header' => trans('Tour Companies')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')

    <div class="row">

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperator.index')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Total companies') }} ~ <badge class="badge badge-primary" style="font-size:14px">{{Auth::user()->getTotalNumberOfCompanies()}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperator.verifiedCompaniesIndex')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Verified companies') }} ~ <badge class="badge badge-primary" style="font-size: 14px">{{Auth::user()->getTotalNumberOfVerifiedCompanies()}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperator.UnverifiedCompaniesIndex')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Unverified companies') }} ~ <badge class="badge badge-primary" style="font-size:14px">{{Auth::user()->getTotalNumberOfUnverifiedCompanies()}}</badge> </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperator.deletedTourCompaniesIndex')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Deleted companies') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{Auth::user()->getTotalNumberOfDeletedTourCompanies()}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>
    <div class="row" style="overflow-x: scroll">
            <div class="col-md-12" >
                <div class="pull-left" style="margin-bottom: 10px" >
                    <a class ='btn btn-primary btn-sm'  href="{{ route('tourOperator.register') }}" style="color: white;padding: 10px 10px 10px 10px">Add Tour Company &blacktriangleright;</a>
                </div>
            </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:150%;background-color:rgba(255,255,255,0.85)">
                    <div class="card-actions">
                        {{--Action Links--}}

                    </div>
                @include('TourOperator.get_tour_operators_companies')
            </section>
        </div>

    </div>
@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
