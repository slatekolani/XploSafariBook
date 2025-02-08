@extends('layouts.main', ['title' => trans('Approved Local Tour Bookings'), 'header' => trans('Approved Local Tour Bookings')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <span>Safari To: <a href="{{route('touristicAttraction.show',$localTourPackage->touristicAttraction->uuid)}}" class="attraction-link" data-toggle="tooltip" data-placement="top" data-attraction-id="{{ $localTourPackage->safari_name }}" style="color: dodgerblue" title="{{$localTourPackage->touristicAttraction->attraction_description }} - {{$localTourPackage->touristicAttraction->basic_information }} ">{{$localTourPackage->touristicAttraction->attraction_name }}</a> - </span>
                    <span>Countdown Days For Tour : {!!$localTourPackage->CountDownDaysForLocalTourPackageTripLabel!!}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 10px">
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourBooking.index',$localTourPackage->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Total Bookings') }} ~ <badge class="badge badge-primary" style="font-size: 14px">{{$localTourPackage->TotalLocalTourBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourBooking.approvedLocalBookingsIndex',$localTourPackage->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Approved Bookings') }} ~ <badge class="badge badge-success" style="font-size: 14px">{{$localTourPackage->TotalLocalApprovedTourBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourBooking.unapprovedLocalBookingIndex',$localTourPackage->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Un Approved Bookings') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$localTourPackage->TotalLocalUnapprovedTourBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourBooking.deletedLocalBookingIndex',$localTourPackage->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Deleted bookings') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$localTourPackage->TotalDeletedLocalTourBookingLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Cancelled bookings') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$localTourPackageBooking->TotalLocalCancelledTripBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>

    <div class="row" style="overflow-x: scroll">
        <div id="notify" style="display: none"></div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:250%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.TourPackages.localTourPackages.bookings.approvedBookings.get_approved_bookings')
            </section>
        </div>

    </div>
@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
