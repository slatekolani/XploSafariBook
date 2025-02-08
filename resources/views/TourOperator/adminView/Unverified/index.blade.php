@extends('layouts.main', ['title' => trans('Unverified Tour Companies'), 'header' => trans('Unverified Tour Companies')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')

<div class="row" style="padding-top: 13px">
    <div id="notify" style="display: none"></div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorCompaniesManagement.index')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Total companies') }} ~ <span class="badge badge-primary" style="font-size: 14px">{{$tourOperator->count()}}</span></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorCompaniesManagement.verifiedTourOperatorsCompaniesIndex')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Verified companies') }} ~ <span class="badge badge-success" style="font-size: 14px">{{$tourOperator->where('status','=',1)->count()}}</span></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorCompaniesManagement.unverifiedTourOperatorsCompaniesIndex')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Unverified companies') }} ~ <span class="badge badge-danger" style="font-size: 14px">{{$tourOperator->where('status','=',0)->count()}}</span> </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorCompaniesManagement.deletedTourCompaniesIndex')}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Deleted companies') }} ~ <span class="badge badge-danger" style="font-size: 14px">{{\App\Models\TourOperator\tourOperator::onlyTrashed()->count()}}</span></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>

    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:100%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.adminView.Unverified.get_unverified_tour_operators_companies')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
