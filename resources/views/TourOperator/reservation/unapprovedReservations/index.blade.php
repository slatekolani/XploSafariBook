@extends('layouts.main', ['title' => trans('Unapproved reservations - ' . $tourOperator->company_name), 'header' => trans('Unapproved reservations - ' . $tourOperator->company_name)])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div id="notify" style="display: none"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorReservation.index',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('All reservations') }} ~ <badge class="badge badge-primary">{{$tourOperator->TotalTourOperatorReservationsLabel}}</badge></h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorReservation.approvedReservationIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Approved reservations') }} ~ <badge class="badge badge-primary">{{$tourOperator->ApprovedTourOperatorReservationsLabel}}</badge> </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorReservation.unapprovedReservationIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Un approved reservations') }} ~ <badge class="badge badge-primary">{{$tourOperator->UnapprovedTourOperatorReservationsLabel}}</badge> </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourOperatorReservation.deletedReservationIndex',$tourOperator->uuid)}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Deleted reservations') }} ~ <badge class="badge badge-primary">{{$tourOperator->DeletedTourOperatorReservationsLabel}}</badge> </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{ route('tourOperatorReservation.create',$tourOperator->uuid) }}" style="color: white;padding: 10px 10px 10px 10px">Add Reservation &blacktriangleright;</a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:150%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.reservation.unapprovedReservations.get_unapproved_reservations')
            </section>
        </div>

    </div>
@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
