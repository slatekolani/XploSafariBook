@extends('layouts.main', ['title' => trans('Approved Cancelled Local Trip Request'), 'header' => trans('Approved Cancelled Local Trip Request')])

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
                    <span>Safari To: <a href="{{route('touristicAttraction.show',$localTourPackageBooking->localTourPackages->touristicAttraction->uuid)}}" class="attraction-link" data-toggle="tooltip" data-placement="top" data-attraction-id="{{ $localTourPackageBooking->localTourPackages->safari_name }}" style="color: dodgerblue" title="{{$localTourPackageBooking->localTourPackages->touristicAttraction->attraction_description }} - {{$localTourPackageBooking->localTourPackages->touristicAttraction->basic_information }} ">{{$localTourPackageBooking->localTourPackages->touristicAttraction->attraction_name }}</a> - </span>
                    <span>Countdown Days For Tour : {!! $localTourPackageBooking->localTourPackages->CountDownDaysForLocalTourPackageTripLabel !!}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6 mb-3">
                            <p><strong>Tourist Name:</strong> {{ $localTourPackageBooking->tourist_name }}</p>
                            <p><strong>Phone Number:</strong> {{ $localTourPackageBooking->phone_number }}</p>
                        </div>
                        <!-- Right Column -->
                        <div class="col-md-6">
                            <p><strong>Email Address:</strong> {{ $localTourPackageBooking->email_address }}</p>
                            <p><strong>Booking Date:</strong> {{ date('jS M Y', strtotime($localTourPackageBooking->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="padding-top: 10px">
        
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTripCancellation.index',$localTourPackageBooking->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('All Cancelled Requests') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$localTourPackageBooking->TotalLocalCancelledTripBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTripCancellation.approvedLocalTripCancelationRequestIndex',$localTourPackageBooking->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Approved Cancelled Requests') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$localTourPackageBooking->TotalApprovedLocalCancelledTripBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTripCancellation.unapprovedLocalTripCancelationRequestIndex',$localTourPackageBooking->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Unapproved Cancelled Requests') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$localTourPackageBooking->TotalUnApprovedLocalCancelledTripBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTripCancellation.deletedLocalTripCancelationRequestIndex',$localTourPackageBooking->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Deleted Cancelled Requests') }} ~ <badge class="badge badge-danger" style="font-size: 14px">{{$localTourPackageBooking->TotalDeletedLocalCancelledTripBookingsLabel}}</badge></h5>
                        <p class=""></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>

    
    <div class="row" style="overflow-x: scroll">
        <div id="notify" style="display: none"></div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:110%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.TourPackages.localTourPackages.bookings.cancelledBookings.approvedCancellation.getApprovedCancellations')
            </section>
        </div>

    </div>
@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush


