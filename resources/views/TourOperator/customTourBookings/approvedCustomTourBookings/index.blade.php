@extends('layouts.main', ['title' => trans('Approved Custom Tour Bookings'), 'header' => trans('Approved Custom Tour Bookings')])

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
                    <a href="{{route('customTourBookings.index',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Total Bookings') }} ~ <badge class="badge badge-primary" style="font-size: 14px">{{$tourOperator->TotalCustomTourBookingsLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('customTourBookings.approvedCustomTourBookingsIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Approved Bookings') }} ~ <badge class="badge badge-primary" style="font-size: 14px">{{$tourOperator->TotalApprovedCustomTourBookingsLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('customTourBookings.unApprovedCustomTourBookingsIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('UnApproved Bookings') }} ~ <badge class="badge badge-primary" style="font-size: 14px">{{$tourOperator->TotalUnApprovedCustomTourBookingsLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('customTourBookings.recentCustomTourBookingsIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Recent Bookings Made') }} ~ <badge class="badge badge-primary" style="font-size: 14px">{{$tourOperator->TotalRecentCustomTourBookingsLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('customTourBookings.nearCustomTourIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Near Tours') }} ~ <badge class="badge badge-info" style="font-size: 14px">{{$tourOperator->TotalNearCustomToursLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('customTourBookings.expiredCustomTourBookingsIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Expired Bookings') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$tourOperator->TotalExpiredCustomTourBookingsLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('customTourBookings.DeletedCustomBookingsIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Retrieve deleted bookings') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$tourOperator->TotalRetrievedDeletedCustomBookingsLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>

    <div class="row" style="overflow-x: scroll">
        <div id="notify" style="display: none"></div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:300%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.customTourBookings.approvedCustomTourBookings.get_approved_custom_tour_bookings')
            </section>
        </div>

    </div>
@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
