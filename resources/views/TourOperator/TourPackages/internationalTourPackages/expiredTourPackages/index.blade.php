@extends('layouts.main', ['title' => trans('Expired International Tour Packages'), 'header' => trans('Expired International Tour Packages')])

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
                    <span class="badge badge-info" style="font-size:15px">Alert</span>
                    <p>We regret to inform you that these tour packages have expired due to the specified dates.
                        However, we have good news! You have the opportunity to renew these packages by changing the
                        dates and, if necessary, modifying other items. Remember, as you renew any of the tour package below, the bookings and their payment histories will automatically be downloaded on your device.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 13px">

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.companyInternationalTourPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('All Posted packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalInternationalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.recentInternationalPostedTourPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Recent Posted packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalRecentInternationalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.verifiedInternationalTourPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Verified Packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalVerifiedInternationalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.unverifiedInternationalTourPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Unverified Packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalUnVerifiedInternationalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.nearInternationalToursToBeConductedIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Near Tours') }} ~
                            <badge class="badge badge-info badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalInternationalNearToursLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.expiredInternationalTourPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Expired Packages') }} ~
                            <badge class="badge badge-danger badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalInternationalExpiredTourPackagesLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackages.deletedInternationalTourPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Deleted Tour Packages') }} ~
                            <badge class="badge badge-danger badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalInternationalDeletedTourPackagesLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12">

            <section class="card card-primary mb-4" style="width:180%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.TourPackages.internationalTourPackages.expiredTourPackages.get_expired_international_tour_packages')
            </section>
        </div>
    </div>

@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
